<?php

if(!empty($_FILES['files']['name'][0]))
{

  $files = $_FILES['files'];

  $uploaded = array();
  $failed = array();

  $allowed = array('jpg', 'gif', 'webp');

  foreach($files['name'] as $position => $file_name)
  {
    $file_tmp = $files['tmp_name'][$position];
    $file_size = $files['size'][$position];
    $file_error = $files['error'][$position];
  
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    if(in_array($file_ext, $allowed)){
        if($file_error === 0){
            if($file_size <= 131072){
                
                $file_name_new = uniqid('', true) . '.' . $file_ext;
                $file_destination = 'uploads/' . $file_name_new;
                
                if(move_uploaded_file($file_tmp, $file_destination)){
                        $uploaded[$position] = $file_destination;

                }else{
                    $failed[$position] = "[{$file_name}] failed to upload";
                }

            }else{
                $failed[$position] = "[{$file_name}] is too large";
            }

        }else{
            $failed[$position] = "[{$file_name}] errored with code {$file_error}";
        }

    }else{
        $failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed ";
    }


    

        if(!empty($uploaded)){
            var_dump($uploaded);
        }

        if(!empty($failed)){
            var_dump($failed);
        }


  }
}

var_dump($_FILES);
?>
