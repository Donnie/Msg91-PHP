# msg91

PHP Composer package for Msg91. Strictly following PSR standards.

## Install

1. Add this repo to your composer.json.
```
,
    "repositories": [
        {
            "type": "vcs",
            "url": "https://git@github.com/Donnie/Msg91-PHP"
        }
    ]
```

2. And require this in composer.json
```
,
    "require": {
        "donnie/msg91-php": "dev-master"
    }
```

3. Run `composer update`

## Usage for OTP

```
use Donnie\Msg91\OTP;

// set your auth key and your sending name
$otp = new OTP('12234..your-authkey...1234', 'MYBIZN');
```

### Send OTP

```
// numbers must have country code
// country code may or may not have + sign in the beginning
// numbers may or may not have zero in the beginning
// in absence of country code by default 91 would be added

$otp->set('919998888777', 'jimkirk@starfleet.com', '320')->send();
// email argument is optional
// third argument is for template ID, optional
// this will send to phone and email

// to send SMS to numbers other than Indian you will need clearance from Msg91 first
```

### Resend OTP

```
// default for second arg is 'voice'
$otp->resend('919998888777', 'text')->send();
```

###  Verify OTP
```
// to verify add phone and code
$res = $otp->get('919998888777', '6984')->send();

// you can read the outcome from $res->type (error || success)
```
