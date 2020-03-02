<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Link;

	Class TestController extends Controller{

		public function index(){
			$articles = Link::get();
			return view('test', ['articles' => $articles]);
		}

		public function show(){
		}
		public function create(){
			//$articles = new Link();
			return view('testcreate');
		}
		public function save(){
			$inputdata = new Link();
			$inputdata->title = request('title');
			$inputdata->url = request('url');
			$inputdata->description = request('description');

			if(request()->image){
				$filename = request()->image->getClientOriginalName();
				$filename = url("/images") ."/" . uniqid() .request()->image->getClientOriginalName();
				$destinationPath = "images";
				request()->image->move($destinationPath, $filename);
				$inputdata->image = $filename;
			}
			$inputdata->save();
			return redirect('/test');

			/* print_r($request);
			$post = request();
			$savedata = array(
				'title' => $post['title'],
				'description' => $post['description'],
			); */
			
		}
		public function display($aid){
			$article = Link::find($aid);
			return view('display', compact('article'));
		}
		public function edit($aid){
			$article = Link::find($aid);
			return view('edit', compact('article'));
			
		}
		public function update(Request $request, $aid){
			/*Link::find($aid)->update($request->all());
			return redirect('/test');*/
			$filename = '';
			if(request()->image){
				$articleimage = Link::find($aid);
				$existfilename= $articleimage->image;
				if(Storage::exists($existfilename)) {
					unlink($existfilename);
				}

				$filename = request()->image->getClientOriginalName();
				$filename = "images/" . uniqid() .request()->image->getClientOriginalName();
				$destinationPath = "images";
				request()->image->move($destinationPath, $filename);
			}
			$updatedata = [
				'title' => request('title'),
				'url' => request('url'),
				'description' => request('description'),
			];
			if($filename){
				$updatedata['image'] = $filename;
			}
			Link::where('id', $aid)->update($updatedata);
			return redirect('/test');
		}
		public function delete($aid){
			Link::find($aid)->delete();
			return redirect('/test');
		}	

		/*public function abctesturl($id){
			echo 'hello';
			if($id){
				echo $id;
			}
		}*/

	}