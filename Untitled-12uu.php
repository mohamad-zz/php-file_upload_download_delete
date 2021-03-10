<?php
    $conn = mysqli_connect('localhost','root','','demo');
    if(isset($_POST['submit'])){
        
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $path = "files/".$fileName;
    $Transaction_ID = $_POST['Transaction_ID'];
    $query = "INSERT INTO filedownload(filename,Transaction_ID) VALUES ('$fileName','$_POST[Transaction_ID]')";
    $run = mysqli_query($conn,$query);
        if($run>=1){
            move_uploaded_file($fileTmpName,$path);

           
    
            echo "success";
        }
        else{
            echo "error".mysqli_error($conn);
        }
        
    
      }

      if(isset($_POST['submit']) || isset($_POST['search1']) || isset($_POST['delete1'])) {
      include('db_connect.php');  

      $C_phone_number = $_POST['C_phone_number'];
      $Transaction_ID= $_POST['Transaction_ID'];
  
      
      if(empty($Transaction_ID)){
  
        
      // id to search
      $C_phone_number = $_POST['C_phone_number'];
  
      
      // mysql search query
      $query = "SELECT Transaction_ID FROM transactions WHERE  C_phone_number= $C_phone_number";
  
    $amount = "";
    $type = "";
    $Case_flag = "";
    $description= "";
    $name = "";
    $Legal_advice_flag = "";
    $date = "";
    $Lawyer_phone_number="";
      }else{
      
      // mysql search query
      $query = "SELECT Transaction_ID, amount, type, Case_flag,description,
      name , Legal_advice_flag ,date, C_phone_number ,Lawyer_phone_number
  
      FROM transactions WHERE  C_phone_number= $C_phone_number and Transaction_ID=$Transaction_ID";
      
      $result = mysqli_query($con, $query);
      
      // if id exist 
      // show data in inputs
      if(mysqli_num_rows($result) > 0)
      {
        while ($row = mysqli_fetch_array($result))
        {
          $Transaction_ID = $row['Transaction_ID'];
          $amount = $row['amount'];
          $type = $row['type'];
          $Case_flag = $row['Case_flag'];
          $description= $row['description'];
          $name = $row['name'];
          $Legal_advice_flag = $row['Legal_advice_flag'];
          $date = $row['date'];
          $C_phone_number = $row['C_phone_number'];
          $Lawyer_phone_number=$row['Lawyer_phone_number'];
  
        }  
      }
      
      // if the id not exist
      // show a message and clear inputs
      else {
        echo '<script> alert("user not found") </script>';
        $Transaction_ID = "";
        $amount = "";
        $type = "";
        $Case_flag = "";
        $description= "";
        $name = "";
        $Legal_advice_flag = "";
        $date = "";
        $C_phone_number = "";
        $Lawyer_phone_number="";
      }
      
    }
  }
     // mysqli_free_result($result);
      //mysqli_close($con);
      
  
  
  // in the first time inputs are empty
      else{
        $Transaction_ID = "";
            $amount = "";
            $type = "";
            $Case_flag = "";
            $description= "";
            $name = "";
            $Legal_advice_flag = "";
            $date = "";
            $C_phone_number = "";
            $Lawyer_phone_number="";
      }
      
    
 
if(isset($_POST['delete1'])){
$conn = mysqli_connect('localhost','root','','demo');
echo 'delete';

$query=mysqli_query($conn, "SELECT * FROM `filedownload` WHERE filename=filename") or die(mysqli_error());
$rows=mysqli_fetch_array($query);

 //  $location=$fetch["files/$rows[id]"];


    if(unlink("files/$rows[filename]")){
        
        
        mysqli_query($conn, "DELETE FROM `filedownload` WHERE filename='$rows[filename]'") or die(mysqli_error());

    }

    

}


?>


<html lang="ar">
<head>

  <link href="Untitled-upload1.css"  media="screen" rel="stylesheet" >

   

    <h1>ادارة الاستشارة القانونية</h1>
  <img src="data:image/png;base64,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" name="people" alt="peopole"
   width="70" height="70" >
   
   <a href="http://localhost/Login.php">
    <img src="data:image/png;base64,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"
     name="home" alt="home"
   width="70" height="70" >
  </a>
  <hr>
</head>
<body>
  
  <div class="container" name="M"> 
       
               <form action="" method="post" enctype="multipart/form-data">
     
  <div class="container" name="c1" id="c1">

  
  
  <input type="number" name="C_phone_number" placeholder=" رقم العميل " value="<?php echo $C_phone_number;?>"required >
  <label for="C_phone_number" name="C_phone_number" dir=right >&nbsp;&nbsp;رقـم الـعمـيـل</label>
  
   <br>
   <input type="number" name="amount" placeholder="المبلغ" value="<?php echo $amount;?>" >
  <label for="amount" name="amount" dir=right >&nbsp;&nbsp;&nbsp;المبلغ&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</label>
 

    <input type="number" name="Lawyer_phone_number" placeholder=" رقم المحامي "value="<?php echo $Lawyer_phone_number;?>">
    <label for="Lawyer_phone_number" name="Lawyer_phone_number" dir=right > رقـم المـحـامـي</label>

    <input type="text" name="name" placeholder="اسم الاستشارة" value="<?php echo $name;?>" >
    <label for="name" name="name" dir=right >اسم الاستشارة</label>


    <input type="date" name="date"value="<?php echo $date;?>">
    <label for="date" name="date" dir=right >&nbsp;&nbsp;تاريخ الاستشارة </label>

    <input type="text" name="type" placeholder="نوع الاستشارة"  value="<?php echo $type;?>">
    <label for="type" name="type" dir=right >نـوع الاستشارة</label>

    
   
<br>
    <label for="description" name="description" dir=right >الوصف</label>
    <textarea name="description"  rows="8" cols="75"><?php echo $description;?></textarea>

  
    </div name="c1">
  <br>
  <div class="container" name="c3" id="c3">

  <table border="1px" align="center" name="T">

  <input type="file" name="file">
                    <button type="submit" name="submit"> Upload</button>
                    <tr>
                    <caption>files</caption>
       
                     <th>ID</th>
                     <th>FILE NAME</th>           
                    <th>transaction id </th>
				    <th>Download</th>
                    <th>delete</th>

                                </tr>

    

    <div class="container" name="c2" id="c2">
    


              <button type="submit" id="search1" name="search1">
                <img src="data:image/png;base64,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
                izNiBQCYt/mvEytM726gZjAfgWsjDd6nBmsfcT+BbLyycub7iQr3FYK8cGoPWZ9r8DDCZ4ANXzhaZvT05
                cANCmcAb6jwYIvfu/vj5jaKUYxiFKMYxScY/wU2+DDpcYvfWgAAAABJRU5ErkJggg=="
                 height="50" width="50" alt="Save icon"/>بحث
                  </button>
               

                  

                  </div name="c2">

<div class="container1" name="f" id="f">
<select name="Transaction_ID"> 
<option value="<?php echo$Transaction_ID;?>">رقم الاستشارة : <?php echo$Transaction_ID;?></option> 

  <?php 
  
      $q=mysqli_query($con,"SELECT * FROM transactions where C_phone_number= $C_phone_number");

  while($r=mysqli_fetch_array($q)){

    ?>

    <option name="Transaction_ID"> <?php echo $r['Transaction_ID'];?> </option>
    <?php
  }?>
  </select>
  </div name="f">


      
              <?php

error_reporting(0);
ini_set('display_errors', 0);

if(isset($_POST['submit']) || isset($_POST['search1']) ||  isset($_POST['delete1']))    
        {
               $Transaction_ID = $_POST['Transaction_ID'];
               $query2 = "SELECT * FROM filedownload where Transaction_ID=$Transaction_ID";
               $run2 = mysqli_query($conn,$query2);
               
    

               while($rows = mysqli_fetch_array($run2)){
                   $id=$rows['id'];
                   $filename=$rows['filename'];
                   $Transaction_ID=$rows['Transaction_ID'];

                   ?>
                   <tr>
            <td><?php echo $rows['id'] ?></td>
            <td><?php echo $rows['filename'] ?></td>
            <td><?php echo $rows['Transaction_ID'] ?></td>
            <td>
               
     <a href="download.php?file=<?php echo $rows['filename'] ?>">download<br>
               </td>
               <td>
               <button type="submit" name="delete1" id="delete1" value="id=<?php echo $rows['filename']?>">delete</button>

               

               </td>

               <?php
               }}
               ?>
          
       </tr>

   </table>
   </div name="c3">

</div>
</form>
</div>
</body>
</html>


