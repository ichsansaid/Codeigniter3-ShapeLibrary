# CodeIgniter 3 Shape Library

Shape is library to help you make a views easily, Shape is a view that rendered before called by other Shape / View

How to install this Library 
- Download this project
- Move Shape.php to your-codeigniter-project-folder/application/library
- Open your-codeigniter-project-folder/application/config/autoload.php
- Add 'shape' to $autoload['libraries']
- Then you can use the Shape !

# Documentation
First you must use extends a view like this :
```sh
#Key = unique id for your View / Shape
#View = view location in codeigniter 3
#Data = data for shape
$this->shape->extend($key, $view, $value);
#Example
$this->shape->extend('db','dashboard', [
	'favicon' => 'localhost/assets/fav.png"
])
```
It means you will use view 'dashboard.html' for the first Shape that will be rendered

and then how to add Shape ?
```sh
#Key = unique id for your Shape
#View = view location in codeigniter 3
#Data = data of shape
$this->shape->addShape($key, $view, $data);
#Example :
$this->shape->addShape('navbar', 'navbar/user_navbar', ['menu'=>true]);
$this->shape->addShape('topbar', 'topbar/user_topbar', ['profile'=>'Said']);
```
If you want to set the data you can do
```sh
$this->shape->setShapeData('navbar', ['menu'=>false]);
```
or can be specific like this :
```sh
$this->shape->setShapeData('navbar', false, 'menu');
```
If you want to set the data for global you can do
```sh
$this->shape->setGlobalData(['title'=>"Point Of Sale");
```
or can be specific like this :
```sh
$this->shape->setGlobalData('title', "Point Of Sale");
```
and then after you've put all the Shapes, if you want to render View and all Shapes to your website, you can do
```sh
$this->shape->render()
```
or if you want to re-extend your view
```sh
$this->shape->render('dashboard2')
```
and then you will see the dasboard2 views

how to render the shape in dashboard2 that has already added in dashboard2 ?

you can do this in your dashboard2.html
```sh
<html>
<?= $shape->render('navbar') ?>
</html>
```
its easy, right ?

and then how to get the navbar's data ?
```sh
<html>
<?= $shape->data('menu') ?>
</html>
```
If you want to get global data you can do
```sh
<html>
<?= $shape->_data('title') ?>
</html>
```
Can you render shape in navbar.html ? Yes you can !

navbar.html
```sh
<html>
<?= $shape->render('topbar') ?>
</html>
```

### Todos

 - Add Bulk Shapes
 - More clean code
 - Transfer data between two Shape

License
----

MIT License

Copyright (c) 2020 Muhammad Al Ichsan Nur Rizqi Said

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE..


### Don't hesitate to contact me if you need help
Email : ichsann.saidd@gmail.com

Instagram : said_nrs

Facebook : https://www.facebook.com/telorjan/

Because my english is so bad, i think i only accept project from indonesian people :(





