<?php

namespace App\Http\Controllers;
use File;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function practiceCode(Request $request){
        $onlycode = $request->codes;
        $lang = $request->language;
        $file = time().rand();
        $destinationPath=public_path()."/storage/";
        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        if($lang == 'c'){
            $withExt = $file.'.c';
            File::put($destinationPath.$withExt,$onlycode);
            $output = null;
            $retval = null;
            $command1 = 'gcc storage/'.$withExt. ' -o storage/'.$file; 
            $command2 = './storage/'.$file;
            exec($command1,$output,$retval);
            exec($command2,$output,$retval);
            $delCommand1 = 'rm storage/'.$withExt;
            $delCommand2 = 'rm storage/'.$file;
            exec($delCommand1);
            exec($delCommand2);
            return $output;
        }
        elseif($lang == 'cpp'){
            $withExt = $file.'.cpp';
            File::put($destinationPath.$withExt,$onlycode);
            $output = null;
            $retval = null;
            $command1 = 'g++ storage/'.$withExt. ' -o storage/'.$file; 
            $command2 = './storage/'.$file;
            exec($command1,$output,$retval);
            exec($command2,$output,$retval);
            $delCommand1 = 'rm storage/'.$withExt;
            $delCommand2 = 'rm storage/'.$file;
            exec($delCommand1);
            exec($delCommand2);
            return $output;
        }elseif($lang == 'python'){
            $withExt = $file.'.py';
            File::put($destinationPath.$withExt,$onlycode);
            $output = null;
            $retval = null;
            $command1 = 'python3 storage/'.$withExt; 
            exec($command1,$output,$retval);
            $delCommand2 = 'rm storage/'.$withExt;
            exec($delCommand2);
            return $output;
        }elseif($lang == 'php'){
            $withExt = $file.'.php';
            File::put($destinationPath.$withExt,$onlycode);
            $output = null;
            $retval = null;
            $command1 = 'php storage/'.$withExt; 
            exec($command1,$output,$retval);
            $delCommand2 = 'rm storage/'.$withExt;
            exec($delCommand2);
            return $output;
        }elseif($lang == 'javascript'){
            $withExt = $file.'.js';
            File::put($destinationPath.$withExt,$onlycode);
            $output = null;
            $retval = null;
            $command1 = 'node storage/'.$withExt; 
            exec($command1,$output,$retval);
            $delCommand2 = 'rm storage/'.$withExt;
            exec($delCommand2);
            return $output;
        }
        
    }
}

        
        
        

