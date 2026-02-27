A quick stash of the test cases I made to make sure my solution for balancing existing uses of Resend-PHP and allowing it to be renamed by dependency isolation tools would actually work. 

If you choose to clone or download these tests to run them yourself, it's just `php index.php` in each individual directory. In every instances you'll be greeted by a Resend API error but that's expected due to me using a fake API key.

In total I made four test cases:

1. `upstream/`
2. `fork/`
3. `mozart/`
4. `scoper/`

## `upstream/`

Nothing was changed here. Functioned as a sanity check to ensure I wasn't breaking existing functionality. I made a new project, ran `composer init` for first-time setup, then ran `composer require resend/resend-php` to pull version `1.1.0` from the real `resend/resend-php` upstream repository.

## `fork/`

My changed but **not isolated** fork. I used Composer's `repositories->url` setting to pull my forked repo instead of the real upstream. Nothing special but useful to ensure I wasn't going to introduce any breaking changes.

## `mozart/`

Uses my fork **with Mozart**. You can see the Resend SDK is added with `use MozartTest\Resend\Resend;` as expected. Context: Mozart is the dependency isolation tool favoured by major WordPress plugins like WooCommerce, so I made the assumption it's what most developers would use. 

Installed with: 
- `composer require coenjacobs/mozart --dev`

Ran with:
- `vendor/bin/mozart compose`

## `scoper/`

Also uses my fork **with PHP-Scoper instead**. Resend is called with `use ScoperTest\Resend\Resend;` as per the included `scoper.inc.php` configuration file. Context: From what I gather PHP-Scoper is a bit more recent than Mozart and [doesn't do quite the same thing, though they're very similar](https://github.com/coenjacobs/mozart/blob/master/docs/background.md#why-not-php-scoper). I thought it best to be thorough and test my changes in multiple of the most common dependency isolation tools.

Installed with: 
- `composer require --dev bamarni/composer-bin-plugin`
- `composer bin php-scoper require --dev humbug/php-scoper`

Ran with:
- `vendor/bin/php-scoper add-prefix --force` (`--force` just skips an interactive prompt notifying you that dependencies are already prefixed)

## Notes

Ultimately neither Mozart nor PHP-Scoper worked properly without additional configuration options, at least with the way I'd installed and ran those tools.

Mozart doesn't handle deeply nested namespaces well, specifically due to the SDK's use of Guzzle that needed to be patched.

PHP-Scoper has issues with PSR-4 autoloaded mappings and ClassLoader strings that will basically always need hacks.

_Most importantly,_ neither is a problem that was introduced by, nor can it be fixed by, the Resend PHP SDK. They're implementation details and limitations of the isolation tools which don't demand SDK changes. I guess they call it PHP dependency hell for a reason! In any case I just felt it prudent to note my findings here, although they're very much beyond the Resend library's scope.
