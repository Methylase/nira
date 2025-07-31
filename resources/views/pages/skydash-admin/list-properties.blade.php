@extends('layouts.admin')
  @section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body" id="property-body">
                                        <p class="card-title">Properties List</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table id="list-properties" class="display expandable-table text-center" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Type</th>
                                                                <th>Area Covered</th>
                                                                <th>Number Of Bed</th>
                                                                <th>Number Of Baths</th>
                                                                <th>Number Of Gaurage</th>
                                                                <th>Amount</th>
                                                                <th>Postal Code</th>
                                                                <th>Address</th>
                                                                <th>State</th>
                                                                <th>Local Govt</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i= 1;?>
                                                            @foreach ($properties as $property )
                                                            <tr>
                    
                                                                <td class="pl-0 pb-0"><?= $i ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->type ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->area ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->bed ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->baths ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->garage ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->amount ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->postalCode ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->address ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->state ?> </td>
                                                                <td class="pl-0 pb-0"><?= $property->localG ?> </td>
                                                                <td class="pl-0 pb-0"> 
                                                                    <?php if(isset($property->status) && $property->status =='rent'): ?>
                                                                        <span  class="bg-warning rounded p-2"><?= ucfirst($property->status) ?></a> 
                                                                    <?php elseif(isset($property->status) && $property->status =='sale'): ?>
                                                                        <span class="bg-danger rounded p-2"><?= ucfirst($property->status) ?></a>
                                                                    <?php endif ?>
                                                                </td>
                                                                <td>
                                                                    <a href="/edit-property/{{$property->id}}" class="btn" title="Edit"><span class="fa fa-edit h3"></span></a>                                         
                                                                    <a href="" class="btn deleteProperty"  id='del {{$property->id}}' data-title="Delete" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash h3" title="Delete"></span></a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;?>
                                                            @endforeach
                                                        </tbody>                 
                                                    </table>

                                                    <!-- modal for delete staff -->
                                                    <div class="modal col-md-10 offset-md-2  col-sm-10 offset-sm-2 " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">                  
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h4 class="modal-title" id="Heading">Delete this Property</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="alert alert-danger  format"><span class="fa fa-warning text-danger"></span> Are you sure you want to delete this property?</div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button  class="btn btn-success del_property"><span class="fa fa-check-circle"></span> Yes</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> No</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of modal for delete property -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection