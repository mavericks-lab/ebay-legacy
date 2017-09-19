<?php
    /**
     * Created by PhpStorm.
     * User: Optimistic
     * Date: 21/03/2015
     * Time: 08:01
     */

    namespace Maverickslab\Ebay;

    use Cloudinary;
    use Cloudinary\Uploader;

    class Picture
    {
        use InjectAPIRequester;

        /**
         * @param     $user_token
         * @param     $image_url
         * @param int $site_id
         *
         * @return mixed|null
         */
        public function upload($user_token, $image_url, $site_id = 0)
        {
            $image_url = self::resize($image_url);

            if ($image_url) {
                $inputs = [];
                $inputs['RequesterCredentials'] = [
                    'eBayAuthToken' => $user_token
                ];

                $inputs['ExternalPictureURL'] = [$image_url];

                $inputs['PictureSet'] = ['Supersize'];

                return $this->requester->request($inputs, 'UploadSiteHostedPictures', $site_id);
            }

            //nothing was done here
            return null;
        }

        /*
        * resize the image
        */
        /**
         * @param $image_url
         *
         * @return array
         */
        public function resize($image_url)
        {
            try {
                $file_info = pathinfo($image_url);

                list($original_width, $original_height) = getimagesize(urldecode($image_url));

                if ($original_width >= 500 || $original_height >= 500) {
                    return $image_url;
                }

                $desired_width = 500;
                $desired_height = (int)ceil(($desired_width / $original_width) * $original_height);

                $cloudinary_image = self::uploadToCloudinary($image_url, [
                    'crop'   => 'scale',
                    'width'  => $desired_width,
                    'height' => $desired_height
                ]);

                return $cloudinary_image['url'];
            } catch (\Exception $ex) {
                return [
                    'Ack'     => 'failure',
                    'message' => $ex->getMessage()
                ];
            }
        }

        /**
         * @param $image_path
         * @param $options
         *
         * @return mixed
         */
        public function uploadToCloudinary($image_path, $options)
        {
            Cloudinary::config([
                "cloud_name" => config('ebay.cloudinary_cloud_name'),
                "api_key"    => config('ebay.cloudinary_api_key'),
                "api_secret" => config('ebay.cloudinary_api_secret')
            ]);

            return Uploader::upload($image_path, $options);
        }
    }