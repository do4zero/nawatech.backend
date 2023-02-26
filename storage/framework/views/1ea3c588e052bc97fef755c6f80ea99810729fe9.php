<div class="p-2">
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
    <div class="flex gap-1 mb-4 mt-4">
        <div class="bg-white flex-1 shadow-sm">
            <div class="text-center">
                <div class="text-gray-500">Total</div>
                <div class="text-7xl p-2"><?php echo e($totalOrder); ?></div>
                <div class="text-sm">Orders</div>
            </div>
        </div>
    </div>
    <div class="flex gap-1 mb-4">
        <div class="bg-white flex-1 shadow-sm">
            <div class="text-center">
                <div class="bg-orange-500 text-white">WAITING</div>
                <div class="text-4xl p-2"><?php echo e($waitingOrder); ?></div>
                <div class="text-sm">Orders</div>
            </div>
        </div>
        <div class="bg-white flex-1 shadow-sm">
            <div class="text-center">
                <div class="bg-red-500 text-white">FAILED</div>
                <div class="text-4xl p-2"><?php echo e($failedOrder); ?></div>
                <div class="text-sm">Orders</div>
            </div>
        </div>
        <div class="bg-white flex-1 shadow-sm">
            <div class="text-center">
                <div class="bg-green-500 text-white">SUCCESS</div>
                <div class="text-4xl p-2"><?php echo e($successOrder); ?></div>
                <div class="text-sm">Orders</div>
            </div>
        </div>
    </div>
</div>

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
                window.livewire.find('<?php echo e($_instance->id); ?>').set('from_date', selected);

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

                window.livewire.find('<?php echo e($_instance->id); ?>').set('to_date', selected);

                dt.setDate(dt.getDate() - 1);
                $("#from_date").datepicker("option", "maxDate", dt);
            }
        });
    });
</script>
<?php /**PATH /home/midpc/Documents/Nawatech/backend/resources/views/livewire/dashboard.blade.php ENDPATH**/ ?>