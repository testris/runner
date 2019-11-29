## Add composer execution via docker

In PHPStorm

Go to `Settings -> Language & Framework -> Composer` choose `Remote iterpreter` and than click to add new interpreter

![Alt text](005.png) 

Select CLI interpreter creation option

![Alt text](006.png)

Select `Docker` and choose your project image

![Alt text](007.png)

And done, now you have remote interpreter in your project 

![Alt text](008.png)

At least you have to do right click by `composer.json -> composer -> install`. Dependencies successfully installed.