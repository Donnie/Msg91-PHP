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
        "Donnie/Msg91-PHP": "dev-master"
    }
```

3. Run `composer update`

## Usage for OTP

```
use Donnie\Msg91\OTP;

$otp = new OTP(config("msg91.auth"), 'MYBIZ');
```

### Send OTP

```
// numbers may or may not have country code
// country code may or may not have + sign in the beginning
// numbers may or may not have zero in the beginning
// in absence of country code

$otp->set('9998888777', 'jimkirk@starfleet.com')->send();
// this will send to phone and email
```

### Resend OTP

```
// default for second arg is 'voice'
$otp->resend('9998888777', 'text')->send();
```

###  Verify OTP
```
// to verify add phone and code
$res = $otp->get('9998888777', '6984')->send();

// you can read the outcome from $res->type (error || success)
```
