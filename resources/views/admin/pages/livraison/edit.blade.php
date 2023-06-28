   {{-- modal update --}}

   <div class="modal fade modal-add-contact" id="editLiv{{ $item['id'] }}" tabindex="-1" role="dialog"
       aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
           <div class="modal-content">
               <form method="POST" action="{{ route('admin.livraison.update' ,$item['id']) }}">
                   @csrf
                   <div class="modal-header px-4">
                       <h5 class="modal-title" id="exampleModalCenterTitle">Modifier
                           livraison - {{ $item['lieu'] }}</h5>
                   </div>

                   <div class="modal-body px-4">
                       <div class="row mb-2">
                           <div class="col-lg-10">
                               <div class="form-group">
                                   <label for="name">Nom de la livraison</label>
                                   <input type="text" name="lieu" value="{{ $item['lieu'] }}" class="form-control"
                                       id="name">
                               </div>
                           </div>

                           <div class="col-lg-10">
                               <div class="form-group">
                                   <label for="name">Tarif de la livraison</label>
                                   <input type="text" name="tarif" value="{{ $item['tarif'] }}"
                                       class="form-control" id="name">
                               </div>
                           </div>

                       </div>

                   </div>

                   <div class="modal-footer px-4">
                       <button type="button" class="btn btn-secondary btn-pill"
                           data-bs-dismiss="modal">Annuler</button>
                       <button type="submit" class="btn btn-primary btn-pill">
                           Enregistrer</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   {{-- end modal update --}}
