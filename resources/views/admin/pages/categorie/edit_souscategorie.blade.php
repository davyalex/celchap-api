   {{-- modal update --}}
                                      
   <div class="modal fade modal-add-contact" id="editSousCat{{ $sous_cat['id'] }}"
   tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
           <form method="POST"
               action="{{ route('admin.sous_categorie.update', $item['id']) }}"
               enctype="multipart/form-data">
               @csrf
               <div class="modal-header px-4">
                   <h5 class="modal-title" id="exampleModalCenterTitle">Modifier
                       sous Categorie {{ $sous_cat['name'] }}</h5>
               </div>

               <div class="modal-body px-4">


                   <div class="row mb-2">
                       <div class="col-lg-10">
                           <div class="form-group">
                               <label for="name">Nom de la categorie</label>
                               <input type="text" name="name"
                                   value="{{ $sous_cat['name'] }}"
                                   class="form-control" id="name">
                           </div>
                       </div>

                    

                   </div>

                   <div class="row mb-2">
                   

                    <div class="col-lg-10">
                     <div class="form-group">
                         <label for="parent-category" class="col-12 col-form-label">
                             <font style="vertical-align: inherit;">
                                 <font style="vertical-align: inherit;">Catégorie Parentale</font>
                             </font>
                         </label>
                         <select id="parent-category" name="category_id" class="form-control">
                             <option disabled value selected>Selectionner</option>
                             @foreach ($categorie as $value)
                                 <option value="{{ $value['id'] }}" {{ $value['id']==$sous_cat['category_id'] ? 'selected' : '' }}>
                                     <font style="vertical-align: inherit;">
                                         <font style="vertical-align: inherit;">{{ $value['name'] }}
                                         </font>
                                     </font>
                                 </option>
                             @endforeach

                         </select>
                     </div>
                 </div>

                </div>
                   
                   <div class="form-group row mb-6">
                       <label for="coverImage"
                           class="col-sm-4 col-lg-2 col-form-label">Categorie
                           Image</label>

                       <div class="col-sm-8 col-lg-6">
                           <div class="custom-file mb-1">
                               <input type="file" name="image"
                                   class="custom-file-input" id="coverImage">
                               <label class="custom-file-label"
                                   for="coverImage">Choose
                                   file...</label>
                               <div class="invalid-feedback">Example invalid
                                   custom file feedback
                               </div>
                           </div>
                       </div>

                       <div class="col-sm-4 col-lg-4">
                           <img class="cat-thumb"
                               src="{{ asset($item->getFirstMediaUrl('image')) }}"
                               alt="Product Image" />
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