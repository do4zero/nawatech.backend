<div>
    <div class="py-5">
        <div class="max-w-md mx-auto">
            <div class="text-lg mb-3">Orders List</div>

            <!-- Input Search -->
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                >
                    <svg
                        aria-hidden="true"
                        class="w-5 h-5 text-gray-500 dark:text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        ></path>
                    </svg>
                </div>
                <input
                    type="search"
                    id="default-search"
                    class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Invoice Code / Customer Information"
                    wire:model="searchTerm"
                />
            </div>

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

            <?php if(session()->has('message')): ?>
            <div
                class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert"
            >
                <div class="flex">
                    <div>
                        <p class="text-sm"><?php echo e(session("message")); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="overflow-hidden rounded-sm text-slate-700 text-sm mt-4">
                <?php $__empty_1 = true; $__currentLoopData = $oderlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white border-b-2 mb-4">
                    <div class="p-3">
                        <div class="flex justify-between mb-2">
                            <label class="font-bold">Invoice</label>
                            <label class="underline">
                                <?php echo e($order->invoice_number); ?>

                            </label>
                        </div>

                        <div
                            class="py-[1px] px-2 border inline-block rounded-[4px] mt-3 mb-2 border-slate-400 text-slate-400"
                        >
                            Customer Information
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Fullname</label>
                            <label><?php echo e($order->name); ?> </label>
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Phone</label>
                            <label><?php echo e($order->phone); ?></label>
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Address</label>
                            <label><?php echo e($order->address); ?></label>
                        </div>

                        <div
                            class="py-[1px] px-2 border inline-block rounded-[4px] mb-2 mt-4 border-slate-400 text-slate-400"
                        >
                            Order Information
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Order Date</label>
                            <label class="text-xs italic">
                                <?php echo e($order->created_at); ?>

                            </label>
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Order Amount</label>
                            <label>
                                Rp
                                <?php echo e(number_format($order->total_amount,2,',','.')); ?>

                            </label>
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Order Qty</label>
                            <label
                                ><?php echo e((int) $order->total_qty); ?> ( items )</label
                            >
                        </div>
                        <div class="flex justify-between">
                            <label class="font-bold">Order Status</label>
                            <label
                                class="<?php echo e($order->status != 'WAITING'? 'bg-green-400' : 'bg-red-400'); ?> py-[0px] px-[10px] rounded-[3px] text-white"
                            >
                                <?php echo e(ucwords(strtolower($order->status))); ?>

                            </label>
                        </div>
                    </div>
                    <div
                        class="flex justify-center bg-slate-700 items-center cursor-pointer"
                        onclick="toggleChildren('item-<?php echo e($order->id); ?>')"
                    >
                        <label class="p-1 rounded-[3px] text-gray-200">
                            See Items ( <?php echo e(count($order->items)); ?> )
                        </label>
                    </div>

                    <div class="p-3 hidden" id="item-<?php echo e($order->id); ?>">
                        <div
                            class="py-[1px] px-2 border inline-block rounded-[4px] mb-2 mt-4 border-slate-400 text-slate-400"
                        >
                            Items Detail
                        </div>
                        <?php $__empty_2 = true; $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                        <div
                            class="text-[0.8rem] border p-2 rounded-md mt-2 mb-3"
                        >
                            <div><?php echo e($item->product_name); ?></div>
                            <div class="flex justify-between text-[0.68rem]">
                                <span>
                                    Rp.
                                    <?php echo e(number_format($item->price,2,',','.')); ?>

                                    x <?php echo e($item->qty); ?>

                                </span>
                                <span class="font-bold"
                                    >Rp.
                                    <?php echo e(number_format($item->amount,2,',','.')); ?></span
                                >
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        <span
                            class="text-center p-2 w-full block bg-yellow-50 rounded-lg"
                        >
                            No Items data found.
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div>
                    <span
                        class="text-center p-5 w-full block bg-yellow-50 rounded-lg"
                    >
                        No Order data found.
                    </span>
                </div>
                <?php endif; ?>
                <div class="py-2">
                    <?php echo e($oderlist->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleChildren(id) {
        const html = document.getElementById(id);
        html.classList.toggle("hidden");
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
<?php /**PATH /home/midpc/Documents/Nawatech/backend/resources/views/livewire/order-list.blade.php ENDPATH**/ ?>