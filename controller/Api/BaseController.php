<?php
    class BaseController{

        /**
         * __call magic method.
         */
        public function __call($name, $arguments)
        {
            $this->sendOutput("", array("http/1.1 404 Not Found"));
        }

        /**
         * GET URI Element.
         * 
         * @return array
         */
        protected function getUriSegments(){
            $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
            $uri = explode("/", $uri);

            return $uri;
        }

        /**
         * GET querystring params
         * 
         * @return array
         */
        protected function getQueryStringParams(){
            parse_str($_SERVER["QUERY_STRING"], $query);
            return $query;
        }

        /**
         * GET API Output
         * 
         * @param mixed $data
         * @param string $HttpHeader
         */
        protected function sendOutput($data, $HttpHeader = array()){
            header_remove("Set-Cookie");

            if(is_array($HttpHeader) && count($HttpHeader)){
                foreach($HttpHeader as $HttpHeader){
                    header($HttpHeader);
                }
            }

            echo $data;
            exit;
        }
    }
?>