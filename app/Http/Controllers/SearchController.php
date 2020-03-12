<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;
use App\Service;
use App\Contracts;
use App\Lawyer;

use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{


   public function search()
   {

      $news = News::all();
      #dd($news);
      $services = Service::all();
      #dd($services);
      $contracts = Contracts::all();
      $lawyers = Lawyer::where('status', 'accepted')->where('specialization_id', '!=', null)->get();
      $array1 = [];
      $array2 = [];
      $array3 = [];
      $array4 = [];
      foreach ($news as $key => $value) {
         if($value->text != ''){
            $array1[] = ['id' => $value->id, 'type' => 'news', 'title' => $value->title, 'text' => strip_tags($value->text), 'updated_at' => $value->updated_at];
         }
      }
      foreach ($services as $key => $value) {
         if($value->description != ''){
            $array2[] = ['id' => $value->id, 'type' => 'services', 'title' => $value->name, 'text' => strip_tags($value->description), 'updated_at' => $value->updated_at];
         }
      }
      foreach ($contracts as $key => $value) {
         if($value->text != ''){
            $array3[] = ['id' => $value->id, 'type' => 'contracts', 'title' => $value->title, 'text' => strip_tags($value->text), 'updated_at' => $value->updated_at];
         }
      }
      foreach ($lawyers as $key => $value) {
         $array4[] = ['id' => $value->id, 'type' => 'lawyers', 'title' => $value->user['lastname'].' '.$value->user['firstname'], 'text' => '', 'updated_at' => $value->updated_at];
      }
      $all = array_merge($array1, $array2, $array3, $array4);
      $search = collect($all)->sortBy('updated_at');
      $needle = request('search');
      if($needle != ''){
         $search = $search->filter(function($item) use($needle) {
            return (mb_stristr($item['text'], $needle) || mb_stristr($item['title'], $needle));
         });
      }
      // $search = $search->where('text', 'like',request('search'))->orWhere('title', 'like',request('search'));

      $search_counter = count($search);
      return view('inner_page.search.index', compact('search', 'search_counter'));
   }

}
