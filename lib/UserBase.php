<?php

namespace Pingpp;

class UserBase extends AppBase
{
    /**
     * @return string The API URL base for user based objects.
     */
     public static function userBaseUrl()
     {
         $appBase = static::appBaseUrl();
         return "${appBase}/users";
     }

    /**
     * @param string The user ID
     * @return string The API URL for user based objects.
     */
     public static function classUrlWithUserId($userId)
     {
         $base = static::userBaseUrl();
         $resourceName = static::className();
         return "${base}/${userId}/${resourceName}s";
     }

     /**
      * @param string The user ID
      * @param string The object ID
      * @return string The API URL for this API resource.
      */
     public static function instanceUrlWithObjectId($userId, $objectId)
     {
         $objectId = Util\Util::utf8($objectId);
         $base = static::classUrlWithUserId($userId);
         $extn = urlencode($objectId);
         return  $base . '/' . $extn;
     }

     public static function _userBasedRetrieve($userId, $id, $options = null)
     {
         $url = static::instanceUrlWithObjectId($userId, $id);
         return static::_directRequest('get', $url, array(), $options);
     }

     public static function _userBasedCreate($userId, $params = null, $options = null)
     {
         $url = static::classUrlWithUserId($userId);
         return static::_directRequest('post', $url, $params, $options);
     }

     public static function _userBasedUpdate($userId, $id, $params = null, $options = null)
     {
         $url = static::instanceUrlWithObjectId($userId, $id);
         return static::_directRequest('put', $url, $params, $options);
     }

     public static function _userBasedList($userId, $params = null, $options =  null)
     {
         $url = static::classUrlWithUserId($userId);
         return static::_directRequest('get', $url, $params, $options);
     }

     public static function _userBasedDelete($userId, $id, $params = null, $options =  null)
     {
         $url = static::instanceUrlWithObjectId($userId, $id);
         return static::_directRequest('delete', $url, $params, $options);
     }
}
