<?php

class Pingpp_Refund extends Pingpp_ApiResource
{
  /**
   * @return string The API URL for this Pingpp refund.
   */
  public function instanceUrl()
  {
    $id = $this['id'];
    $charge = $this['charge'];
    if (!$id) {
      throw new Pingpp_InvalidRequestError(
          "Could not determine which URL to request: " .
          "class instance has invalid ID: $id",
          null
      );
    }
    $id = Pingpp_ApiRequestor::utf8($id);
    $charge = Pingpp_ApiRequestor::utf8($charge);

    $base = self::classUrl('Pingpp_Charge');
    $chargeExtn = urlencode($charge);
    $extn = urlencode($id);
    return "$base/$chargeExtn/refunds/$extn";
  }

  /**
   * @return Pingpp_Refund The saved refund.
   */
  public function save()
  {
    $class = get_class();
    return self::_scopedSave($class);
  }
}