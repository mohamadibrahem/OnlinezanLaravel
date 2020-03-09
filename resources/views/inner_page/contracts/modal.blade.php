<div class="modal fade" id="ContractDownload" tabindex="-1" role="dialog" aria-labelledby="ContractDownloadLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">

         <form action="{{route('download_contract', $contract->id)}}" method="post">
            {{csrf_field()}}
            <div class="modal-header">
               <h5 class="modal-title" id="ContractDownloadLabel">Договор</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="text">
                  <p>{{$contract->title}}</p>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Оплатить @if($contract->price != null) ({{$contract->price}} тг) @endif </button>
               </div>
            </form>

         </div>
      </div>
   </div>
