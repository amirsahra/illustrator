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

Updating images is also very simple as above, and instead of the upload method, we use update with the parameter of the complete directory of the image that we want to update.

```php
Illustrator::setDisk('public')
    ->setName('myDesiredName')
    ->setDir('images/users')
    ->update($request->imageFieldName,$imagePath);
```




