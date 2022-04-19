
<x-app-layout>
    <div class="container mx-auto">
      {!! Form::open(['route'=>'accounts.store','class'=>'w-full max-w-lg mx-auto']) !!}





      <div class="flex flex-wrap justify-center -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
             {!! Form::label("date_expenses", "Fecha de gasto", ['class'=> 'label-control']) !!}
             {!! Form::date("date_expenses", null, ['class'=>'form-control']) !!}
          </div>


      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("area_id", "Areas", ['class'=>'label-control']) !!}
             {!! Form::select("area_id", $areas, null , ["class"=>"form-control",'placeholder' => 'Selecciona una caja...']) !!}

             @error('area_id')
             <br>
             <small>
              *{{$message}}
             </small>
             <br>
             @enderror
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("supplier", "Proveedor", ['class'=>'label-control']) !!}
              {!! Form::text("supplier", null , ["class"=>"form-control"]) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
        <div class="w-full px-3">
            {!! Form::label("nit", "Nit", ['class'=>'label-control']) !!}
            {!! Form::text("nit", null , ["class"=>"form-control"]) !!}
        </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("types_box_id", "Tipo de caja", ['class'=>'label-control']) !!}
             {!! Form::select("types_box_id", $typesBoxes, null , ["class"=>"form-control",'placeholder' => 'Selecciona una caja...']) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("cost_center_id", "centro de costo", ['class'=>'label-control']) !!}
             {!! Form::select("cost_center_id", $costscenter, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un centro de costo...']) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("cost_sub_center_id", "cliente subcentro de costo", ['class'=>'label-control']) !!}
             {!! Form::select("cost_sub_center_id", $costsSubcenter, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un subcentro de costo...']) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("expense_id", "Gasto", ['class'=>'label-control']) !!}
             {!! Form::select("expense_id", $expenses, null , ["style"=>"width:100%;",'placeholder' => 'Selecciona un gasto...']) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("otro", "otro", ['class'=>'label-control']) !!}
              {!! Form::text("otro", null , ["class"=>"form-control"]) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
             {!! Form::label("types_document_id", "Tipos de documentos", ['class'=>'label-control']) !!}
              @foreach ($typedocuments as $document)


              <div class="mx-4" style="display: inline-block" >
                  {!! Form::label("types_document_id", $document->name, ['style'=>'display:inline-block !important','class'=>'label-control']) !!}

                  {!! Form::radio("types_document_id", $document->id, null, [""]) !!}

              </div>



              @endforeach
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("identification", "No Identificacion", ['class'=>'label-control']) !!}
              {!! Form::text("identification", null , ["class"=>"form-control"]) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("subtotal", "subtotal", ['class'=>'label-control']) !!}
              {!! Form::text("subtotal", null , ["class"=>"form-control"]) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("iva", "iva", ['class'=>'label-control']) !!}
              {!! Form::text("iva", null , ["class"=>"form-control"]) !!}
          </div>
      </div>

      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
              {!! Form::label("total", "total", ['class'=>'label-control']) !!}
              {!! Form::text("total", null , ["class"=>"form-control"]) !!}
          </div>
      </div>


      <div class="flex flex-wrap  mb-6 mx-auto">
          <div class="w-full px-3">
          {!! Form::submit("Registrar", ["class"=>"rounded bg-indigo-600 text-white py-2  px-8"]) !!}
          </div>
      </div>






        {!!Form::close() !!}
    </div>



    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
          $('#cost_center_id').select2({ });
          $('#cost_sub_center_id').select2({ });
          $('#expense_id').select2({ });

      });
    </script>

    <script>



  $("#subtotal").on({
    "focus": function(event) {
      $(event.target).select();
    },
    "keyup": function(event) {
      $(event.target).val(function(index, value) {

         return value.replace(/\D/g, "")
          .replace(/([0-9])([0-9]{3})$/, '$1.$2')
          .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");

      });
    },"change": function(event){
      let subtotal =  document.querySelector('#subtotal').value.replace(/[$.,]/g,'');
      let iva =  document.querySelector('#iva').value.replace(/[$.,]/g,'');
      let total = validationChange(iva,subtotal);
      console.log(typeof total);
      document.querySelector('#total').value = change_output(total) ;

    }

  });

  $("#iva").on({
    "focus": function(event) {
      $(event.target).select();
    },
    "keyup": function(event) {
      $(event.target).val(function(index, value) {

         return value.replace(/\D/g, "")
          .replace(/([0-9])([0-9]{3})$/, '$1.$2')
          .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");

      });
    },"change": function(event){
      let subtotal =  document.querySelector('#subtotal').value.replace(/[$.,]/g,'');
      let iva =  document.querySelector('#iva').value.replace(/[$.,]/g,'');
      let total = validationChange(iva,subtotal);
      document.querySelector('#total').value = change_output(total) ;

    }

  });



  function change_output(value){
        let output = value.replace(/\D/g, "")
        let output_1 = output.replace(/([0-9])([0-9]{3})$/, '$1.$2');
        let output_2 = output_1.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");

        return output_2;

  }




  //       $("#subtotal").keyup(function(){
  //     value_subtotal = string_to_number(document.querySelector('#subtotal').value) ;
  //     value_iva = string_to_number(document.querySelector('#iva').value);
  //     console.log(value_iva);
  //     console.log(value_subtotal);
  //     let total = validationChange(value_iva,value_subtotal);
  //     document.querySelector('#total').value = cambio_input(String(total)) ;

  // })

  // $("#subtotal").keydown(function (e) {
  //     valuesubtotal = document.querySelector('#subtotal').value;
  //     if(valuesubtotal == "" || null){
  //         valuesubtotal = 0;
  //     }
  // });




  // $("#iva").keyup(function(){
  //     value_subtotal = document.querySelector('#subtotal').value;
  //     value_iva = document.querySelector('#iva').value;
  //     let total = validationChange(value_iva,value_subtotal);
  //     document.querySelector('#total').value = cambio_input(String(total));
  //     // ;
  // })

  // $("#iva").keydown(function (e) {
  //     iva = document.querySelector('#iva').value;
  //     if(iva == "" || null){
  //         iva = 0;
  //     }
  // });

  const validationChange = (iva,subTotal) =>{

      if(iva == "" || null){
          iva = 0;
      }

      if(subTotal == "" || null){
          subTotal = 0;
      }



  console.log(iva)
  console.log(subtotal)
      let calculado =  Number(iva) + Number(subTotal) ;

  if(calculado == 0){
      calculado = "";
  }

      return String(calculado);


  }





        </script>
  @endpush
  </x-app-layout>






