<?php
date_default_timezone_set('Europe/London');
//PEtunjuk : https://developers.google.com/oauthplayground/ HARUS dan WAJIB
// ID of the Blog Site to Post to. The ID below is for our test site.
$blogID = $_POST["blogid"];
// Token you will need to authenticate with . It will come from the oAuth.
//$token = 'ya29.a0AeTM1id_h6U7nq4LHjWUS7JZ7j9SLQBt3j1ehro16ElDQiVBmZSMl_LrxbBWnr1Kktizv9WRuCZDdk-uHXiwF8wZSJKtLxZ29hW9hG9F9gX6ay7l3yWeVoeMUsTnWiBOUIWBDBj-TuxwWquvPWlDT4rHhlORUeMaCgYKAYUSAQ8SFQHWtWOmo4MGtXQr4PeVql5_4AdVIA0166';
$token = $_POST["token"];
// Currently hard coded. This needs to come from the new form. The Time is fixed to 08:00:00 time.
$start_date = $_POST["tanggal"];   
// Currently hard coded. This needs to come from the new form 
$article_count = 1; 
// Loop through and create the articles
//for ($x = 0;$x <= $article_count;$x++)
{
$path = 'myDirectory';
$files = glob("{$path}/*.txt");
foreach($files as $file) {
$content = file_get_contents($file);
}

$judul = $_POST["name"];
$tag = $_POST["label"];
$isi = $_POST["postingan"];
    // The data to send to the API
    $postData = array(
        'kind' => 'blogger#post',
        'blog' => array(
            'id' => $blogID
        ) ,
        'title' => $judul ,
        "labels" => $tag ,
        "published" => date('Y-m-d\TH:i:sP', strtotime($start_date)) ,
        'content' => $isi
    );
    //$start_date = date('Y-m-d H:i:s', strtotime($start_date . ' +1 month'));
    // Setup cURL
    $ch = curl_init('https://www.googleapis.com/blogger/v3/blogs/' . $blogID . '/posts/');
    curl_setopt_array($ch, array(
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ) ,
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));
    // Send the request
    $response = curl_exec($ch);
    // Check for errors
    if ($response === false)
    {
        die(curl_error($ch));
    }
    //echo ($response);
    // Decode the response
    //$responseData = json_decode($response, true);
    // Print the date from the response
    //echo $responseData['published'];
    echo ($response);
    // Decode the response
    $responseData = json_decode($response, true);
    // Print the date from the response
    echo $responseData['published'];
    if (isset($judul))
    {   
    ?>
<script type="text/javascript">
setTimeout(
  function(){
    window.location = "https://HatefulMellowSnake.afdgfggfhgfhjh.repl.co" 
  },
6000); // waktu tunggu atau delay
</script>      
    <?php
    }
}
?>