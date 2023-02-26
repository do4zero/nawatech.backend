<div class="p-2">
  <div class="text-lg">Dashboard</div>
  <div class="mt-5">Shortcut Link</div>
  <div class="py-4">
    <button
      class="bg-white hover:bg-slate-700 hover:text-slate-700 text-slate-700 py-1 px-3 rounded-full border border-slate-700"
      onclick="salinToko('{{ $bagikanLink }}')"
    >
      Salin Link
    </button>
    <button
      class="bg-white hover:bg-slate-700 hover:text-slate-700 text-slate-700 py-1 px-3 rounded-full border border-slate-700"
      onclick="menujuToko('{{ $bagikanLink }}')"
    >
      Toko
    </button>
    <a
      href="{{ route('orderlist') }}"
      class="bg-white hover:bg-slate-700 hover:text-slate-700 text-slate-700 py-1 px-3 rounded-full border border-slate-700"
      onclick="menujuToko('{{ $bagikanLink }}')"
    >
      Daftar order
    </a>
    <a
      href="{{ route('products') }}"
      class="bg-white hover:bg-slate-700 hover:text-slate-700 text-slate-700 py-1 px-3 rounded-full border border-slate-700"
      onclick="menujuToko('{{ $bagikanLink }}')"
    >
      Daftar Produk
    </a>
  </div>

  <div>Order Status</div>
  <div class="flex justify-between gap-2 mt-2">
    <input
      type="text"
      id="from_date"
      wire:model="from_date"
      class="flex-1 w-[100px] text-[0.8rem] p-3 px-4 border border-gray-300 rounded-md"
      placeholder="From Date"
    />
    <input
      type="text"
      id="to_date"
      wire:model="to_date"
      class="flex-1 w-[100px] text-[0.8rem] p-3 px-4 border border-gray-300 rounded-md"
      placeholder="To Date"
    />
  </div>

  <div class="flex gap-1 mb-4 mt-5">
    <div class="bg-white flex-1 shadow-sm">
      <div class="text-center">
        <div class="text-gray-500">Total</div>
        <div class="text-7xl p-2">{{ $totalOrder }}</div>
        <div class="text-sm">Orders</div>
      </div>
    </div>
  </div>
  <div class="flex gap-1 mb-4">
    <div class="bg-white flex-1 shadow-sm">
      <div class="text-center">
        <div class="bg-orange-500 text-white">WAITING</div>
        <div class="text-4xl p-2">{{ $waitingOrder }}</div>
        <div class="text-sm">Orders</div>
      </div>
    </div>
    <div class="bg-white flex-1 shadow-sm">
      <div class="text-center">
        <div class="bg-red-500 text-white">FAILED</div>
        <div class="text-4xl p-2">{{ $failedOrder }}</div>
        <div class="text-sm">Orders</div>
      </div>
    </div>
    <div class="bg-white flex-1 shadow-sm">
      <div class="text-center">
        <div class="bg-green-500 text-white">SUCCESS</div>
        <div class="text-4xl p-2">{{ $successOrder }}</div>
        <div class="text-sm">Orders</div>
      </div>
    </div>
  </div>
</div>

<script>
  function copyToClipboard(text) {
    var dummy = document.createElement('textarea');
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
  }

  function salinToko(text) {
    copyToClipboard(text);
    alert('link toko berhasil disalin : ' + text);
  }

  function menujuToko(location) {
    window.location.href = location;
  }
</script>

<link
  rel="stylesheet"
  href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css"
/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
  $(document).ready(function(){
      $("#from_date").datepicker({
          dateFormat: "yy-mm-dd",
          changeYear: true,
          changeMonth: true,
          onSelect: function (selected) {
              var dt = new Date(selected);
              @this.set('from_date', selected);

              dt.setDate(dt.getDate() + 1);
              $("#to_date").datepicker("option", "minDate", dt);
          }
      });

      $("#to_date").datepicker({
          dateFormat: "yy-mm-dd",
          changeYear: true,
          changeMonth: true,
          onSelect: function (selected) {
              var dt = new Date(selected);

              @this.set('to_date', selected);

              dt.setDate(dt.getDate() - 1);
              $("#from_date").datepicker("option", "maxDate", dt);
          }
      });
  });
</script>
