@extends('layouts.app')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Data List
                        <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('myproductsDeleteAll') }}">Delete All Selected</button> 
                        <a href="{{ url('add-student') }}" class="btn btn-success float-end">Add Stduent</a>
                    </h4>

                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID
                                    <input type="checkbox" id="master"></th>  
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Section</th>
                                <th class="text-center">Action</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $item)
                            <tr>
                                <td>{{ $item->id }}<input type="checkbox" class="sub_chk" data-id="{{$item->id}}"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->course }}</td>
                                <td>{{ $item->section }}</td>
                                <td class="text-center">
                                    <a href="{{ url('edit-student/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                  </td>
                                <td class="text-center">
                                    <form action="{{ url('delete-student/'.$item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                  </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">  
    $(document).ready(function ()
    {  
        $('#master').on('click', function(e)
        {
            if($(this).is(':checked',true))
            {
                $(".sub_chk").prop('checked', true);
            }
            else
            {
                $(".sub_chk").prop('checked',false);
            }
        });  
   
        


        $('.delete_all').on('click', function(e) {  
            var allVals = [];    
            $(".sub_chk:checked").each(function() {    
                allVals.push($(this).attr('data-id'));  
            });    
  
            if(allVals.length <=0)    
            {    
                alert("Please select row.");    
            }  else {    
                var check = confirm("Are you sure you want to delete this row?");    
                if(check == true){    
                    var join_selected_values = allVals.join(",");   
                    $.ajax({  
                        url: $(this).data('url'),
                        type: 'DELETE',  
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},  
                        data: 'ids='+join_selected_values,  
                        success: function (data) {  
                            if (data['success']) {  
                                $(".sub_chk:checked").each(function() {    
                                    $(this).parents("tr").remove();  
                                });  
                                alert(data['success']);  
                            } else if (data['error']) {  
                                alert(data['error']);  
                            } else {  
                                alert('Whoops Something went wrong!!');  
                            }  
                        },  
                        error: function (data) {  
                            alert(data.responseText);  
                        }  
                    });  
                  $.each(allVals, function( index, value ) {  
                      $('table tr').filter("[data-row-id='" + value + "']").remove();  
                  });  
                }    
            }    
        }); 
    });  
</script>  