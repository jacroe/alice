<?php
/*
NAME:         Tracking Packages
ABOUT:        Checks a given string for a shipping number
DEPENDENCIES: None;
*/
function alice_packages($data)
{
	$ups = "/\b(1Z ?[0-9A-Z]{3} ?[0-9A-Z]{3} ?[0-9A-Z]{2} ?[0-9A-Z]{4} ?[0-9A-Z]{3} ?[0-9A-Z]|[\dT]\d\d\d ?\d\d\d\d ?\d\d\d)\b/i";
	$fedex = "/\b((96\d\d\d\d\d ?\d\d\d\d|96\d\d) ?\d\d\d\d ?d\d\d\d( ?\d\d\d)?)\b/i";
	$usps = "/\b(9\d\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d|9\d\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d\d\d ?\d\d\d\d)\b/i";
	if (preg_match($ups, $data, $matches))
	{
		$service = "UPS";
		$url = "http://wwwapps.ups.com/WebTracking/processInputRequest?TypeOfInquiryNumber=T&InquiryNumber1={$matches[0]}";
	}
	elseif (preg_match($fedex, $data, $matches))
	{
		$service = "Fedex";
		$url = "http://www.fedex.com/Tracking?tracknumbers={$matches[0]}";
	}
	elseif (preg_match($usps, $data, $matches))
	{
		$service = "USPS";
		$url = "http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?strOrigTrackNum={$matches[0]}";
	}
	
	return array("service"=>$service, "number"=>$matches[0], "url"=>$url);
}
