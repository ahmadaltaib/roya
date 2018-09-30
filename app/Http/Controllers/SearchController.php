<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    App\Elastic\Handler;

class SearchController extends Controller{

    public function search($sKeyword = ''){

        $sSearchStr  = trim(trim($sKeyword));
        $sSearchStr  = str_replace(str_split('\\/:*\'\\\$%^&()+-#!?"<>|'), "", $sSearchStr);

        $errorMsg = "";
        if (!isset($sSearchStr) || empty($sSearchStr)) {
            $sErrorMsg = __('roya.EMPTY_SEARCH');
        } else if (strlen($sSearchStr) <= 2) {
            $sErrorMsg = __('roya.SHORT_SEARCH');
        }

        if (!empty($sErrorMsg)) {
            return view('search.fail', [
                'sMessage' => $sErrorMsg,
                'sKeyword' => $sKeyword
            ]);
        } else {
            $sResult = Handler::searchByKeyword($sSearchStr);
            $oResult = json_decode($sResult);

            if((double)$oResult->dTotal == 0){
                return view('search.fail', [
                    'sMessage' => __('roya.NO_RESULTS'),
                    'sKeyword' => $sKeyword
                ]);
            }else{
                return view('search.success', [
                    'aResults' => $oResult->aResult,
                    'sKeyword' => $sKeyword,
                    'dTotal'   => $oResult->dTotal,
                ]);
            }
        }
    }


}
