<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> --}}
    @include('bcdn')
    <style>
      .form-control
      {
        /* border:1px solid #28a745; */
        border: 1px solid rgba(0, 0, 0, 0.69);
      }
      #selection
      {
        border-radius: 5px;
      }
      nav{
        height: inherit;
      }
    </style>
</head>
<body>
      @include('navbar')
        
        <div class="container w-sm-100">
      
         <form action="add" method="POST" enctype="multipart/form-data">
      
      
          
            <div class="row justify-content-lg-center justify-content-md-center ">
              @csrf
{{--               
              <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                <span>Pick Category</span>
                @php                  
                    use App\Models\Category;
                    $categories=Category::all();
                @endphp
                <div>
                <select name="category" id="Category" style="height:35px;" class="my-2" onclick="subcats(this.value)">
                @foreach($categories as $i)
                <option value="{{$i->category_id}}">{{$i->category_name}}</option>  
                @endforeach
                </select> 
                </div>
                 --}}
                
                {{-- <span class="text-danger">
                  @error('order_title')
                  {{$message}}
                  @enderror
                </span> --}}
              {{-- </div> --}}
            
                
              {{-- </select>  --}}
           
           

              <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                <span>What is your project about ?</span>
                <div>
                {{-- <select name="subcategory_id" id="SubCategory" style="height:35px;" class="my-2">
                


                </select>  --}}
                @php
                $subcate=DB::table('subcategories')->get();
                @endphp
                   <input list="categories" name="subcategory_name" id="browser">
                <datalist id="categories">                     
                  @foreach($subcate as $s)
                  <option value="{{$s->subcategory_name}}"></option>
                  @endforeach
                </datalist>
                </div>
                
                
                {{-- <span class="text-danger">
                  @error('order_title')
                  {{$message}}
                  @enderror
                </span> --}}
              </div>


              <div class="col-lg-8 col-md-8 col-sm-12 form-group my-2">
                <span>Project Title</span>
                <input  value="{{old('order_title')}}" type="text" name="order_title" id="" placeholder="ex. I need a Freelancer Web developer" class="form-control my-2">
                <span class="text-danger">
                  @error('order_title')
                  {{$message}}
                  @enderror
                </span>
              </div>
              
              <div class="col-lg-8 col-md-8 col-sm-12 form-group my-2">
                <span>Project Description</span>
                <textarea name="order_desc" value="{{old('order_desc')}}" id="order_desc" cols="30" rows="10" placeholder="Describe your project here..." class="form-control my-2"></textarea>
                <span class="text-danger">
                  @error('order_desc')
                  {{$message}}
                  @enderror
                </span>
              </div>

              <div class="col-lg-8 col-md-8 col-sm-12 form-group my-2">
                <span>Skills</span>
                
                <input type="text" name="skills[]" id="skill" class="form-control">
                <span class="text-danger">
                  @error('skill')
                  {{$message}}
                  @enderror
                </span>
              </div>

            
              <div class="col-lg-8 col-md-8 col-sm-12 form-group my-2">
                <span>Project Detail File</span> 
                <input type="file" class="form-control" style="border:none;" name="order_info" id="detail_file" multiple>
                <span class="text-danger">
                  @error('order_desc')
                  {{-- {{$message}} --}}
                  @enderror
                </span>
              </div>

              
              {{-- <div class="col-lg-8 col-md-8 col-sm-12 form-group my-3">
                <span>Project Type</span>
                <select name="order_type" class="border border-success mx-3" id="selection">
                  <option value="H">Hourly</option>
                  <option value="F">Fixed</option>
                </select>
                
                <span class="text-danger">
                  @error('budget_price')
                  {{$message}}
                  @enderror
                </span>
              </div>
               --}}
              <div class="col-lg-8 col-md-8 col-sm-12 form-group my-2">
                <span>Budget Price</span>
                <input  value="{{old('order_title')}}" type="number" name="budget" id="" placeholder="budget price in usd" class="form-control my-2">
                <span class="text-danger">
                  @error('budget_price')
                  {{$message}}
                  @enderror
                </span>
              </div>
              
              <div class="col-lg-8 col-md-8 col-sm-12 form-group my-3">
                <input  type="submit" value="Submit Project" class="btn form-control my-2 text-light" style="background: rgb(112, 48, 202)" >
              </div>

              

            </div>
          </form>
          
         
        </div>
      </div>
</body>

{{-- <script>
  function subcats(catval)
  {
    fetch('http://127.0.0.1:8000/subcat/'+ catval).
    then(response=> response.json()).
    then(data =>{
      if(data.length>0){
        document.getElementById('SubCategory').innerHTML= " ";
      for (let index = 0; index < data.length; index++) {
        document.getElementById('SubCategory').innerHTML= 
        document.getElementById('SubCategory').innerHTML +
        '<option value='+data[index].subcategory_id+'>'+data[index].subcategory_name+'</option>' ;
        
      }
    }
    else
    {
      // document.getElementById('SubCategory').innerHTML="<option value=null>could'nt fetch value due to server error</option>" ;
    }
    
      
      }
      );
  }
  
  // document.getElementById('Category').addEventListener('click', function()
  // {
  //   document.getElementById('SubCategory').style.display="block";
    
  // });
</script> --}}
</html>
