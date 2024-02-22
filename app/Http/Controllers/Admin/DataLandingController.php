<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\Landing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Popup;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DataLandingController extends Controller
{
    // company data setup    
        public function index()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.index',$data);
            
        }
        public function edit(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.edit', compact('data'));
        }
        public function update(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[
                'address' => ['required', 'string'],
                'address_city' => ['required', 'string'],
                'address_province' => ['required', 'string'],
                'address_poscode' => ['required', 'string'],
                'hotline' => ['required', 'string'],
                'email' => ['required', 'string', 'email'],
                'whatsapp' => ['required', 'string'],
                'instagram' => ['required', 'string'],
                'tiktok' => ['required', 'string'],
                'youtube' => ['required', 'string'],           
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator); 
                
            $data['address'] = $request->address;
            $data['address_city'] = $request->address_city;
            $data['address_province'] = $request->address_province;
            $data['address_poscode'] = $request->address_poscode;
            $data['hotline'] = $request->hotline;
            $data['email'] = $request->email;
            $data['whatsapp'] = $request->whatsapp;
            $data['instagram'] = $request->instagram;
            $data['tiktok'] = $request->tiktok;
            $data['youtube'] = $request->youtube;        

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.company');
        }    

    // front landing header section
        public function home()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.home',$data);
            
        }
        public function edithome(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.edithome', compact('data'));
        }
        public function updatehome(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[                       
                'head_title' => ['required', 'string'],
                'head_desc' => ['required', 'string'],
                'head_image' => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
                'title_product' => ['required', 'string'],         
                'title_product_2' => ['required', 'string'],
                'title_join' => ['required', 'string'],
                'desc_join' => ['required', 'string'],
                'title_join_1' => ['required', 'string'],
                'join_1' => ['required', 'string'],
                'title_join_2' => ['required', 'string'],
                'join_2' => ['required', 'string'],      
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        
            if (request()->hasFile('head_image')){
                $foto_file      = $request->file('head_image');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->head_image);

                $data = [
                    'head_image' => $foto_nama
                ];
            }

            if (request()->hasFile('image_join')){
                $foto_file      = $request->file('image_join');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->image_join);

                $data = [
                    'image_join' => $foto_nama
                ];
            }

            $data['head_title'] = $request->head_title;
            $data['head_desc']  = $request->head_desc;
            $data['title_product'] = $request->title_product; 
            $data['title_product_2'] = $request->title_product_2;
            $data['title_join'] = $request->title_join;
            $data['desc_join'] = $request->desc_join;
            $data['title_join_1'] = $request->title_join_1;
            $data['join_1'] = $request->join_1;
            $data['title_join_2'] = $request->title_join_2;
            $data['join_2'] = $request->join_2;  

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.home');
        }
    // front landing affiliator section
        public function kawan()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.kawan',$data);
            
        }
        public function editkawan(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.editkawan', compact('data'));
        }
        public function updatekawan(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[  
                'kawan_head_title' => ['required', 'string'],
                'kawan_head_desc' => ['required', 'string'],
                'kawan_content_title' => ['required', 'string'],
                'kawan_content_title_2' => ['required', 'string'], 
                'kawan_content_title_svg_1' => ['required', 'string'],
                'kawan_content_title_svg_2' => ['required', 'string'],
                'kawan_content_title_svg_3' => ['required', 'string'],
                'kawan_content_desc_svg_1' => ['required', 'string'],
                'kawan_content_desc_svg_2' => ['required', 'string'],
                'kawan_content_desc_svg_3' => ['required', 'string'],
                'kawan_content_img' => ['nullable','mimes:png,jpg,svg', 'max:2048'],
                'kawan_content_video_img' => ['nullable','mimes:png,jpg,svg', 'max:2048'],
                'kawan_content_svg_1' => ['nullable','mimes:png,jpg,svg', 'max:2048'],
                'kawan_content_svg_2' => ['nullable','mimes:png,jpg,svg', 'max:2048'],
                'kawan_content_svg_3' => ['nullable','mimes:png,jpg,svg', 'max:2048'],
                'kawan_content_video' => ['nullable','mimes:mp4,webm'],
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            // dd($request->all());

            if (request()->hasFile('kawan_content_video')){
                $video_file      = $request->file('kawan_content_video');
                $video_ekstensi  = $video_file->extension();
                $video_nama      = date('ymdhis') ."." .$video_ekstensi;
                $video_file->move(public_path('img/landing'), $video_nama);
                
                $data_video      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_video->kawan_content_video);

                $data = [
                    'kawan_content_video' => $video_nama
                ];
            }

            if (request()->hasFile('kawan_content_video_img')){
                $foto_file      = $request->file('kawan_content_video_img');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->kawan_content_video_img);

                $data = [
                    'kawan_content_video_img' => $foto_nama
                ];
            }

            if (request()->hasFile('kawan_content_svg_3')){
                $foto_file      = $request->file('kawan_content_svg_3');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->kawan_content_svg_3);

                $data = [
                    'kawan_content_svg_3' => $foto_nama
                ];
            }

            if (request()->hasFile('kawan_content_svg_2')){
                $foto_file      = $request->file('kawan_content_svg_2');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->kawan_content_svg_2);

                $data = [
                    'kawan_content_svg_2' => $foto_nama
                ];
            }

            if (request()->hasFile('kawan_content_svg_1')){
                $foto_file      = $request->file('kawan_content_svg_1');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->kawan_content_svg_1);

                $data = [
                    'kawan_content_svg_1' => $foto_nama
                ];
            }

            if (request()->hasFile('kawan_content_img')){
                $foto_file      = $request->file('kawan_content_img');
                $foto_ekstensi  = $foto_file->extension();
                $foto_nama      = date('ymdhis') ."." .$foto_ekstensi;
                $foto_file->move(public_path('img/landing'), $foto_nama);
                
                $data_foto      = landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_foto->kawan_content_img);

                $data = [
                    'kawan_content_img' => $foto_nama
                ];
            }    
                        
            $data['kawan_head_title'] = $request->kawan_head_title;
            $data['kawan_head_desc'] = $request->kawan_head_desc;
            $data['kawan_content_title'] = $request->kawan_content_title;
            $data['kawan_content_title_2'] = $request->kawan_content_title_2;
            $data['kawan_content_title_svg_1'] = $request->kawan_content_title_svg_1;
            $data['kawan_content_title_svg_2'] = $request->kawan_content_title_svg_2;
            $data['kawan_content_title_svg_3'] = $request->kawan_content_title_svg_3;
            $data['kawan_content_desc_svg_1'] = $request->kawan_content_desc_svg_1;
            $data['kawan_content_desc_svg_2'] = $request->kawan_content_desc_svg_2;
            $data['kawan_content_desc_svg_3'] = $request->kawan_content_desc_svg_3;

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.kawan');
        }

    // aturan page
        public function aturan()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.aturan',$data);
            
        }
        public function editaturan(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.editaturan', compact('data'));
        }
        public function updateaturan(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[  
                'aturan_title' => ['required', 'string'],
                'aturan_desc' => ['required', 'string'],
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            $data['aturan_title'] = $request->aturan_title;
            $data['aturan_desc'] = $request->aturan_desc;

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.aturan');
        }

    // kebijakan page
        public function kebijakan()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.kebijakan',$data);
            
        }
        public function editkebijakan(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.editkebijakan', compact('data'));
        }
        public function updatekebijakan(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[  
                'kebijakan_title' => ['required', 'string'],
                'kebijakan_desc' => ['required', 'string'],
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
            // dd($request->all());            
                        
            $data['kebijakan_title'] = $request->kebijakan_title;
            $data['kebijakan_desc'] = $request->kebijakan_desc;

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.kebijakan');
        }
    
    // faq page
        public function faq()
        {
            $faqs = Faq::get();
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                'faqs'          => $faqs,
                
            );

            return view('admin.pages.landing.faq',$data);
            
        }
        public function createfaq()
        {
            return view('admin.pages.landing.createfaq');
        }
        public function storefaq(Request $request)
        {
            $request->validate([
                'addMoreInputFields.*.title' => 'required',
                'addMoreInputFields.*.desc' => 'required'
            ],[
                'addMoreInputFields.*.title' => 'The Name Field is required!',
                'addMoreInputFields.*.desc' => 'The Name Field is required!',
            ]);    
            
            foreach ($request->addMoreInputFields as $key => $value) {
                    Faq::create($value); 
            } 

            return redirect()->route('dashboard.landingdata.faq');
        }    
        public function editfaq(string $id)
        {
            $data = Faq::find($id);
            return view('admin.pages.landing.editfaq', compact('data'));
            
        }
        public function updatefaq(Request $request, string $id)
        {
            $validator = Validator::make($request->all(),[
                'title' => ['required', 'string', 'max:255'],
                'desc' => ['required'],

            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            $data['title'] = $request->title;
            $data['desc'] = $request->desc;
        
            Faq::whereId($id)->update($data);

            return redirect()->route('dashboard.landingdata.faq');
        }

    // klaim page
        public function klaim()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.klaim',$data);
            
        }
        public function editklaim(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.editklaim', compact('data'));
        }
        public function updateklaim(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[  
                'img_header_klaim' => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
                'desc_step_4_klaim' => ['required', 'string'],
                'title_step_4_klaim' => ['required', 'string'],
                'desc_step_3_klaim' => ['required', 'string'],
                'title_step_3_klaim' => ['required', 'string'],
                'desc_step_2_klaim' => ['required', 'string'],
                'title_step_2_klaim' => ['required', 'string'],
                'desc_step_1_klaim' => ['required', 'string'],
                'title_step_1_klaim' => ['required', 'string'],
                'desc_body_klaim' => ['required', 'string'],
                'title_body_klaim' => ['required', 'string'],
                'desc_header_klaim' => ['required', 'string'],
                'title_header_klaim' => ['required', 'string'],
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);     
            
            if (request()->hasFile('img_header_klaim')){
                $img_header_klaim           = $request->file('img_header_klaim');
                $img_header_klaim_ekstensi  = $img_header_klaim->extension();
                $img_header_klaim_nama      = date('ymdhis') ."." .$img_header_klaim_ekstensi;
                $img_header_klaim->move(public_path('img/landing'), $img_header_klaim_nama);
                
                $data_img_header_klaim      = Landing::where('id', $id)->first(); 
                File::delete(public_path('img/landing'). '/' . $data_img_header_klaim->img_header_klaim);

                $data = [
                    'img_header_klaim' => $img_header_klaim_nama
                ];
            }
                        
            $data['desc_step_4_klaim'] = $request->desc_step_4_klaim;
            $data['title_step_4_klaim'] = $request->title_step_4_klaim;
            $data['desc_step_3_klaim'] = $request->desc_step_3_klaim;
            $data['title_step_3_klaim'] = $request->title_step_3_klaim;
            $data['desc_step_2_klaim'] = $request->desc_step_2_klaim;
            $data['title_step_2_klaim'] = $request->title_step_2_klaim;
            $data['desc_step_1_klaim'] = $request->desc_step_1_klaim;
            $data['title_step_1_klaim'] = $request->title_step_1_klaim;
            $data['desc_body_klaim'] = $request->desc_body_klaim;
            $data['title_body_klaim'] = $request->title_body_klaim;
            $data['desc_header_klaim'] = $request->desc_header_klaim;
            $data['title_header_klaim'] = $request->title_header_klaim;

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.klaim');
        }

    // fee data setup
        public function fee()
        {
            $landing = Landing::get();

            $data = array(
                'landing'       => $landing,
                
            );

            return view('admin.pages.landing.fee',$data);
            
        }
        public function editfee(string $id)
        {
            $data = Landing::find($id);
            return view('admin.pages.landing.editfee', compact('data'));
        }
        public function updatefee(Request $request, $id) 
        {
            $validator = Validator::make($request->all(),[
                'admin_fee' => ['required', 'string'],
                'materai_fee' => ['required', 'string'],         
            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

            $data['admin_fee'] = $request->admin_fee;
            $data['materai_fee'] = $request->materai_fee;   

            Landing::whereId($id)->update($data);
            return redirect()->route('dashboard.landingdata.fee');
        }
    // popup page
        public function popup()
        {
            $popup      = Popup::get();
            $landing    = Landing::get();

            $data = array(
                'landing'       => $landing,
                'popup'         => $popup,
                
            );

            return view('admin.pages.landing.popup',$data);
            
        }    
        public function editpopup(string $id)
        {
            $data = Popup::find($id);
            return view('admin.pages.landing.editpopup', compact('data'));
            
        }
        public function updatepopup(Request $request, string $id)
        {
            $validator = Validator::make($request->all(),[
                'popup'     => ['nullable','mimes:png,jpg,jpeg,svg', 'max:2048'],
                'status'    => ['required','integer'],

            ]);

            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);            


            if (request()->hasFile('popup')){
            $popup           = $request->file('popup');
            $popup_ekstensi  = $popup->extension();
            $popup_nama      = date('ymdhis') ."." .$popup_ekstensi;
            $popup->move(public_path('img/landing'), $popup_nama);
            
            $data_popup      = Popup::where('id', $id)->first(); 
            File::delete(public_path('img/landing'). '/' . $data_popup->popup);

            $data = [
                'popup' => $popup_nama
            ];
        }

            $data['status'] = $request->status;
        
            Popup::whereId($id)->update($data);

            return redirect()->route('dashboard.landingdata.popup');
        }

    
}
