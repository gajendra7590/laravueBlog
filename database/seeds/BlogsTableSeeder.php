<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\models\Blogs;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $html = '<h2>What is Lorem Ipsum?</h2>
                    <p><strong>Lorem Ipsum</strong> is simply dummy text of the 
                    printing and typesetting industry. Lorem Ipsum has been the industrys 
                    standard dummy text ever since the 1500s, when an unknown printer took a 
                    galley of type and scrambled it to make a type specimen book. 
                    It has survived not only five centuries, but also the leap into 
                    electronic typesetting, remaining essentially unchanged. It was 
                    popularised in the 1960s with the release of Letraset sheets containing
                    Lorem Ipsum passages, and more recently with desktop publishing software 
                    Like Aldus PageMaker including versions of Lorem Ipsum.</p> 
                    <h2>Why do we use it?</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable 
                    content of a page when looking at its layout. The point of using Lorem Ipsum is that 
                    it has a more-or-less normal distribution of letters, as opposed to using 
                    Content here, content here, making it look like readable English. 
                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their 
                    default model text, and a search for lorem ipsum will uncover many web 
                    sites still in their infancy. Various versions have evolved over the years, sometimes 
                    by accident, sometimes on purpose (injected humour and the like).
                    </p>';
          $blog_title = 'What is Lorem Ipsum';
          $blog_url = 'What-is-lorem-lpsum';
          $blog_name = 'What is Lorem Ipsum'; 
          $categoreis = ['1','1','1','2','2','3','3','4','5','6'];  
          $noOfBlogCreate = 10;
          $array = ['blog_name'=>'','blog_title'=>'','blog_url'=>'',
                      'blog_desc'=>'','blog_user'=>'','blog_category'=>'',
                      'blog_image'=>''];  
        Blogs::truncate();
        for($i=1;$i <=$noOfBlogCreate;$i++){ 
            $array = array('blog_name' => $blog_name.' '.$i,
                      'blog_title'=> $blog_title.' '.$i,
                      'blog_url'=> $blog_url.'-'.$i,
                      'blog_desc'=> $html,
                      'blog_user'=>'2',
                      'blog_category'=>$categoreis[$i-1],
                      'blog_image'=>'default/default'.$i.'.jpg');  
                 Blogs::create($array);    
        }
    }
}
