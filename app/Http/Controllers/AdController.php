<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdController extends Controller
{
    private function linkConvert(&$arrs)
    {
        foreach ($arrs as $arr) {
            $arr->links = json_decode($arr->links)[0];
        }
        $arrs = $arrs->paginate(10);
    }

    public function index(Request $request)
    {
        if (isset($request->price)) {
            if ($request->price == 'sort') {
                $ads = Cache::remember('psort', Carbon::now()->addMinutes(10), function () {
                    return Ad::select('id', 'text', 'price', 'links')->orderBy('price')->get();
                });
                $this->linkConvert($ads);
            }
            if ($request->price == 'desc') {
                $ads = Cache::remember('pdesc', Carbon::now()->addMinutes(10), function () {
                    return Ad::select('id', 'text', 'price', 'links')->orderByDesc('price')->get();
                });
                $this->linkConvert($ads);
            }
            return response($ads, 200);
        }
        if (isset($request->date)) {
            if ($request->date == 'sort') {
                $ads = Cache::remember('datesort', Carbon::now()->addMinutes(10), function () {
                    return Ad::select('id', 'text', 'price', 'links')->orderBy('created_at')->get();
                });
                $this->linkConvert($ads);
            }
            if ($request->date == 'desc') {
                $ads = Cache::remember('datedesc', Carbon::now()->addMinutes(10), function () {
                    return Ad::select('id', 'text', 'price', 'links')->orderByDesc('created_at')->get();
                });
                $this->linkConvert($ads);
            }
            return response($ads, 200);
        } else {
            $ads = Cache::remember('ads', Carbon::now()->addMinutes(10), function () {
                return Ad::select('id', 'text', 'price', 'links')->get();
            });
            $this->linkConvert($ads);
            return response($ads, 200);
        }
    }

    public function oneAd(Request $request, $id)
    {
        $this->id = $id;
        $ad = Cache::remember('oneAd_'.$id, Carbon::now()->addMinutes(10), function () {
            return Ad::find($this->id);
        });
        if ($ad != null) {
            $out = array(
                'text' => $ad->text,
                'price' => $ad->price,
                'image' => json_decode($ad->links)[0]
            );
            $fields = explode(',', $request->fields);
            foreach ($fields as $field) {
                $field = trim($field);
                if ($field == 'description') {
                    $out['description'] = $ad->description;
                }
                if ($field == 'images') {
                    $out['images'] = $ad->links;
                }
            }
            return response($out, 200);
        } else {
            $message = array(
                'result' => 'Error',
                'reason' => 'Запись не найдена'
            );
            return response($message, 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'bail|required|string|max:200',
            'description' => 'bail|required|max:1000',
            'price' => 'required',
            'images' => 'required',[
                function ($attribute, $value, $fail) use ($request) {
                    $count = count(json_decode($request->images));
                    if ($count > 3 || $count == null) {
                        $fail('Количество изображений превышает 3');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            $reason = '';
            $text = $validator->errors()->first('text');
            if ($text != "") $reason = $reason.' + '.$text;
            $text = $validator->errors()->first('description');
            if ($text != "") $reason = $reason.' + '.$text;
            $text = $validator->errors()->first('images');
            if ($text != "") $reason = $reason.' + '.$text;
            $message = array(
                'result' => 'Error',
                'reason' => $reason
            );
            return response($message, 412);
        }

        $ad = new Ad();
        $ad->text = $request->text;
        $ad->price = $request->price;
        $ad->description = $request->description;
        $ad->links = $request->images;
        $ad->save();

        Cache::add('newrec', $ad, Carbon::now()->addMinutes(10));

        $message = array(
            'result' => 'Success',
            'id' => $ad->id,
        );

        return response($message, 200);
    }
}
