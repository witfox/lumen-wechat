<?php
namespace WitFox\LumenWechat\Http\Middleware;

use Illuminate\Support\Facades\Request;
use Closure;

class LWeChartCheck
{
    public function handler(Request $request, Closure $next)
    {
        $signature = $request->input('signature');
        $timestamp = $request->input('timestamp');
        $nonce     = $request->input('nonce');

        $echoStr   = $request->input('echostr');

        // 加密过程
        $token = "witfoxchen";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        // 加密的判断
        if( $tmpStr == $signature ){
            // 额外修改的代码
            if (empty($echoStr)) { // 加密成功之后输出的判断
                return $next($request);
            } else {
                return response($echoStr);
            }
        }else{
            return response(false);
        }
    }
}
