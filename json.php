<!-- 
// $user='root';
// $password='';
// $host='localhost';
// $db='datab';
// $conn=mysqli_connect($host,$user,$password,$db);
// if(!$conn)
// {
//     die("Unable to connect".mysqli_connect_error());
// }
//     $jsondata1 = file_get_contents("https://fakestoreapi.com/products");
//     if($jsondata1==false)
//     {
//         die("Error");
//     }
//     $jsondata=json_decode($jsondata1,true);
//     foreach($jsondata as $data)
//     {
//     $id=$data['id'];
//     $title=$data['title'];
//     $price=$data['price'];
//     $description=$data['description'];
//     $category=$data['category'];
//     $image=$data['image'];
//     $rate=$data['rating']['rate'];
//     $count=$data['rating']['count'];
//     $sqlsuery="INSERT INTO details(Id,Title,Price,Description,Category,Image,Rate,Count) VALUES ( $id,$title,$price,$description,$category,$image,$rate,$count)";
//     }
//     if(mysqli_query($conn,$sqlquery))
//     {
//         echo "Details entered successfully";
//     }
//     mysqli_close($conn); -->

<!DOCTYPE html> 
<html>
    <head>
        <style>
            table th,td {
            border:1px solid black;
         }
         .modal{
            display:none;
            position:fixed;
            background-color: rgb(0,0,0);
            z-index:1;
            background-color: rgb(0,0,0,0.4);
            overflow:auto;
            top:0;
            width: 80%; 
         }
         .modalc{
            background-color: white;
            margin:10px;
            padding: 20px;
           border: 1px solid #888;
           width: 80%; 

         }
         .close{
            float:right;
         }
         #data{
            width:100%;
            height:100%;
         }
         td{
            display:table-cell;
         }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
     <button type="button" name="sdata" id="sdata">Show Data</button>
     <div>
        <table id="data" style="width:100%">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Images</th>
                <th>Rating</th>
                <th>Details</th>
            </tr>
        </table>
       </div>
<div id="myModal" class="modal">
  <div class="modalc">
    <button class="close"><span>x</span></button>
    <div id="details"></div>
  </div>
</div>

      <script>
        $(document).ready(function()
        {
            $("#sdata").click(function()
            {
                $.ajax({
                    url:"https://fakestoreapi.com/products", dataType:'json',success:function(result){
                        var arr="";
                        arr+='<tr>';
                        $.each(result,(key,value) =>
                        {
                            arr+= '<td id="id">' + value.id + '</td>';
                            arr+= '<td id="title">' + value.title + '</td>';
                            arr+= '<td id="price">' + value.price + '</td>';
                            arr+= '<td id="description">'+ value.description + '</td>';
                            arr+= '<td id="category" >' + value.category + '</td>';
                            arr+='<td id="image"> <img style="display:block;" width="100%" height="100%" src='+ value.image + '>'+ '</td>';
                            arr+='<td id="rate"> rate: '+value.rating.rate+'<br> count: '+value.rating.count+'</td>';
                            arr+='<td id="count"> <button type="button" class="det" data-id="'+value.id+'">Details</button></td>';
                            arr+='</tr>';
                        });
                        $("#data").append(arr);
                    }
                });     
            });
            $(document).on('click','.det',function()
            {
                var id=$(this).attr("data-id");
                console.log(id);
                $.ajax({
                url:"https://fakestoreapi.com/products/"+id,dataType:'json',success:function(result1){
                    var arr1="";
                    $.each(result1,(key,value) =>{
                        if(key=="rating")
                        {
                            arr1+="rate: "+value.rate;
                            arr1+='<br>';
                            arr1+="count: "+value.count;
                        }
                        else
                        {
                        arr1+=key+": "+value;  
                        arr1+='<br>';
                        }
                    });
                    $("#details").html(arr1);

                    $("#myModal").show();
                }
             });
            });
            $(document).on('click','.close',function()
            {
                $(".modal").fadeOut();
            });
        });
      </script>
    </body>
</html>