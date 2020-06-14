<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//use Session;
//use Auth;
class testApi extends Controller
{
	public function testLink(){
		$responseData = array(
			array('id'=>'1','price'=>'23,500','name'=>'The X','address'=>'23 cross ,Alex, Egypt','numBed'=>'2','numBath'=>'3','numParking'=>'1'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover1.png','descrption'=>" is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image3.png')
				),
			),

			array('id'=>'1','price'=>'11,320','name'=>'The y','address'=>'23 cross ,Alex, Egypt','numBed'=>'3','numBath'=>'1','numParking'=>'2'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover2.png','descrption'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image3.png')
				),
			),
			array('id'=>'1','price'=>'3,650','name'=>'The z','address'=>'23 cross ,Alex, Egypt','numBed'=>'1','numBath'=>'2','numParking'=>'3'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover3.png','descrption'=>"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image4.png')
				),
			),
			array('id'=>'1','price'=>'23,500','name'=>'The X','address'=>'23 cross ,Alex, Egypt','numBed'=>'2','numBath'=>'3','numParking'=>'1'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover1.png','descrption'=>" is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image3.png')
				),
			),

			array('id'=>'1','price'=>'11,320','name'=>'The y','address'=>'23 cross ,Alex, Egypt','numBed'=>'3','numBath'=>'1','numParking'=>'2'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover2.png','descrption'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image3.png')
				),
			),
			array('id'=>'1','price'=>'3,650','name'=>'The z','address'=>'23 cross ,Alex, Egypt','numBed'=>'1','numBath'=>'2','numParking'=>'3'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover3.png','descrption'=>"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image4.png')
				),
			),
			array('id'=>'1','price'=>'23,500','name'=>'The X','address'=>'23 cross ,Alex, Egypt','numBed'=>'2','numBath'=>'3','numParking'=>'1'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover1.png','descrption'=>" is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image3.png')
				),
			),

			array('id'=>'1','price'=>'11,320','name'=>'The y','address'=>'23 cross ,Alex, Egypt','numBed'=>'3','numBath'=>'1','numParking'=>'2'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover2.png','descrption'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image3.png')
				),
			),
			array('id'=>'1','price'=>'3,650','name'=>'The z','address'=>'23 cross ,Alex, Egypt','numBed'=>'1','numBath'=>'2','numParking'=>'3'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover3.png','descrption'=>"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image4.png')
				),
			),
			array('id'=>'1','price'=>'23,500','name'=>'The X','address'=>'23 cross ,Alex, Egypt','numBed'=>'2','numBath'=>'3','numParking'=>'1'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover1.png','descrption'=>" is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image3.png')
				),
			),

			array('id'=>'1','price'=>'11,320','name'=>'The y','address'=>'23 cross ,Alex, Egypt','numBed'=>'3','numBath'=>'1','numParking'=>'2'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover2.png','descrption'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using',
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image4.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image3.png')
				),
			),
			array('id'=>'1','price'=>'3,650','name'=>'The z','address'=>'23 cross ,Alex, Egypt','numBed'=>'1','numBath'=>'2','numParking'=>'3'
				,'coverPhoto'=>'http://irondot.com/admin/images/img/cover3.png','descrption'=>"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden",
				'features'=>array(
					array('key'=>'movie','value'=>'2Km'),
					array('key'=>'shopping','value'=>'10Km'),
					array('key'=>'sports','value'=>'7.5Km'),
				),
				'images'=>array(
					array('http://irondot.com/admin/images/img/image1.png','http://irondot.com/admin/images/img/image2.png','http://irondot.com/admin/images/img/image4.png')
				),
			),
		);
		$categoryResponse = json_encode($responseData);
        print $categoryResponse;
	}
}