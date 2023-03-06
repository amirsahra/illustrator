<img src="https://www.designbombs.com/wp-content/uploads/2021/08/best-photo-storage-apps-sites.png">

# illustrator

<a href="https://github.com/JosephSilber/bouncer/blob/master/LICENSE.txt"><img src="https://poser.pugx.org/silber/bouncer/license.svg" alt="License"></a>

## Introduction

Easy management of image addition and update

My most important concerns in working with images have been naming and determining where to store them. That's why I
decided to develop this package so that any programmer who, like me, is tired of this naming and choosing the directory
to save images, can use it and upload an image to the desired directory without additional work.

It also has the ability to update the target image, which means the target image is deleted and the new image is saved.
so easily.

After installation, you can easily use illustrator only with the help of corrupting its facade.

```php
// Upload the image with the default values set in the config file of this package
Illustrator::upload($request->imageFieldName);

// Upload the image to the desired directory
Illustrator::setDir('images/users')->upload($request->imageFieldName);

// Upload the image to the desired name
Illustrator::setName('myDesiredName')->upload($request->imageFieldName);

// Upload the image to the desired disk
Illustrator::setDisk('public')->upload($request->imageFieldName);

//You can use this method together, but the upload method must be at the end.
Illustrator::setDisk('public')
    ->setName('myDesiredName')
    ->setDir('images/users')
    ->upload($request->imageFieldName);
```

Updating images is also very simple as above, and instead of the upload method, we use update with the parameter of the
complete directory of the image that we want to update.

```php
Illustrator::setDisk('public')
    ->setName('myDesiredName')
    ->setDir('images/users')
    ->update($request->imageFieldName,$imagePath);
```

### Disks

According to the capabilities of Laravel, we have two types of storage disks. `public` and `local` If we want to access an
image with a URL (such as a user's image, banner, etc.), its disk must be `public`, and if we want an image that can only
be downloaded securely (such as invoices, transaction lists, and any image that security is) its disk must be `local`.

## Installation

- You can install the package using composer:

```php
composer require amirsahra/illustrator
```

- Add the following class to the providers array in `config/app.php`
```php
Amirsahra\Illustrator\IllustratorServiceProvider::class,
```

- You need to add the config file to the config directory. Publish the configuration file:

```php
php artisan vendor:publish --tag="illustrator"
```

### WARNING

If this command did not publish any files, chances are, the Laratrust service provider hasn't been registered. Try
clearing your configuration cache.

```php
php artisan config:clear
```

And

```php
composer dump-autoload
```
### The Public Disk
To use the `public` disk according to the Laravel feature, you need to create a link.

To create the symbolic link, you may use the storage:link Artisan command:
```php
php artisan storage:link
```


## Usage

For example, you have a model name MyImage with these fields
```php
  id,
  path,
  created_at,
  updated_at
```

- ### configs
In the configuration file, the activation of the options and their default values are determined.

Let's start by config
  You edit the config file related to the package that is located in the config directory named illustrator with the publish command (which is explained in the installation section).

  
This is the default value, and if needed,

| key                                  | value (default)    | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
|:-------------------------------------|:-------------------|:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `disk`                               | `public`           | You can choose the disk you want.<br/>This is the default value, and if needed,<br/>you can choose the desired disk when saving the image.<br/>Supported Drivers: "local", "public"                                                                                                                                                                                                                                                                                                                                                          |
| `image_path.dir`                     | `illustrator/imgs` | Default directory to save images                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| `image_path.random_string.length`    | `10`               | If you want the name of the image to be created by default and include a random string, set this feature to active and set the string length.                                                                                                                                                                                                                                                                                                                                                                                                |
| `image_path.random_string.is_active` | `true`             | You can enable and disable this feature.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| `image_path.prefix.value`            | `pre`              | If you want the name of the image to be created by default and include a prefix, set this feature to active and set the prefix value.                                                                                                                                                                                                                                                                                                                                                                                                        |
| `image_path.prefix.is_active`        | `true`             | You can enable and disable this feature.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| `image_path.postfix.value`           | `po`               | If you want the name of the image to be created by default and include a postfix, set this feature to active and set the postfix value.                                                                                                                                                                                                                                                                                                                                                                                                      |
| `image_path.postfix.is_active`       | `true`             | You can enable and disable this feature.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |

- ### Facade
You will easily access it with the help of Facade Package.
Just use it in the use class.
```php
use Amirsahra\Illustrator\Facade\Illustrator;

Illustrator::upload($request->imageFieldName);
```

- ### Upload
This method alone is enough to upload the image. Other values, including directory, name, prefix, and extension, if enabled, are taken from the default value set in the configuration.

The input parameter of the method is of type UploadedFile and it is taken from the sent request that contains the image.

The return of this method is the full address of the image that you use to access the image. Note that the return of this method is saved as the address of the image in the database.

Consider this example :

In form
```php
<form method="post" action="{{route('uploadImage')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <div>
        <label for="file">Choose file to upload</label>
        <input type="file" id="file" name="imageInput" multiple/>
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
```
In class or controller method
```php
namespace App\Http\Controllers;

use Amirsahra\Illustrator\Facade\Illustrator;
use App\MyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imgPath = Illustrator::upload($request->imageInput);
        MyImage::create([
            'path' => $imgPath
        ]);

        return Redirect::back()->with(['msg' => 'successfully']);
    }
}
```

- ### Directory
You can enter your directory.
If you want to use the default directory you specified in the config file, you don't need to use this method.

```php
namespace App\Http\Controllers;

use Amirsahra\Illustrator\Facade\Illustrator;
use App\MyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imgPath = Illustrator::setDir('myDirectory/images')->upload($request->imageInput);
        MyImage::create([
            'path' => $imgPath
        ]);

        return Redirect::back()->with(['msg' => 'successfully']);
    }
}
```
- ### Name
Specify the name of the image or by default it will create a random string with the length you specified in the config file.

Note: The name of the image must be without its type and its type is taken from the image file itself, for example, the name `imageName.png` is incorrect
```php
namespace App\Http\Controllers;

use Amirsahra\Illustrator\Facade\Illustrator;
use App\MyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imgPath = Illustrator::setName('imageName')->upload($request->imageInput);
        MyImage::create([
            'path' => $imgPath
        ]);

        return Redirect::back()->with(['msg' => 'successfully']);
    }
}
```

- ### Disk
You have two modes for the disk: public and local

If you want to access an image with its address, you must select the disk as public.

If you want the image to be protected and only downloadable, select local disk.
```php
namespace App\Http\Controllers;

use Amirsahra\Illustrator\Facade\Illustrator;
use App\MyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imgPath = Illustrator::setDisk('public')->upload($request->imageInput);
        MyImage::create([
            'path' => $imgPath
        ]);

        return Redirect::back()->with(['msg' => 'successfully']);
    }
}
```
### Imag access
With the address of the image (which is created when uploading) and the type of disk, the image can be accessed correctly.

If we want the image to be shown on the pages, its disk must be public, and by adding `storage/` to the first of that address, the image will be displayed, as in the following example:

```php
<img src="{{asset("storage/myDirectory/images/imageName.png")}}" alt="image" >
```
If we want the image to be protected and can only be downloaded, select its local disk.

To protected access the image at the address that the disk was local to when it was saved:
```php
Storage::disk('local')->download('myDirectory/images/imageName.png');
```
- ### Combination of methods

All methods can be used together, but the upload method must come last
```php
namespace App\Http\Controllers;

use Amirsahra\Illustrator\Facade\Illustrator;
use App\MyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imgPath = Illustrator::setName('imageName')
            setDir('myDirectory/images')
            setDisk('public')
            ->upload($request->imageInput);
            
        MyImage::create([
            'path' => $imgPath
        ]);

        return Redirect::back()->with(['msg' => 'successfully']);
    }
}
```
- ### Upload
Updating the images is very simple as above and instead of the upload method, you should use the update with the full directory parameter of the image you want to update.

In this way, the current image is deleted and the new image replaces it
namespace App\Http\Controllers;
```php
use Amirsahra\Illustrator\Facade\Illustrator;
use App\MyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
public function updateImage(Request $request,MyImage $myImage)
{
    $newImgPath = Illustrator::setName('imageName')
        setDir('myDirectory/images')
        setDisk('public')
        ->update($request->imageInput,$myImage->path);

        $myImage->update([
            'path' => $newImgPath
        ]);

        return Redirect::back()->with(['msg' => 'update image successfully']);
    }
}
```
# License

[MIT](https://choosealicense.com/licenses/mit/)

