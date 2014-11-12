<?php

class PingPP_Refund extends PingPP_ApiResource
{
  /**
   * @return string The API URL for this PingPP refund.
   */
  public function instanceUrl()
  {
    $id = $this['id'];
    $charge = $this['charge'];
    if (!$id) {
      throw new PingPP_InvalidRequestError(
          "Could not determine which URL to request: " .
          "class instance has invalid ID: $id",
          null
      );
    }
    $id = PingPP_ApiRequestor::utf8($id);
    $charge = PingPP_ApiRequestor::utf8($charge);

    $base = self::classUrl('PingPP_Charge');
    $chargeExtn = urlencode($charge);
    $extn = urlencode($id);
    return "$base/$chargeExtn/refunds/$extn";
  }

  /**
   * @return PingPP_Refund The saved refund.
   */
  public function save()
  {
    $class = get_class();
    return self::_scopedSave($class);
  }
}