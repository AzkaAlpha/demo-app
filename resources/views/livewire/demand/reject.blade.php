<div>
    <flux:modal name="reject-demand" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tolak Permintaan?</flux:heading>
    
                <flux:subheading>
                    <p>Please provide a reason for rejecting this order.</p>
                </flux:subheading>
            </div>

            <div class="flex flex-col gap-4">
                <flux:input label="Rejection Note" placeholder="Enter reason for rejection" wire:model="note" />
            </div>
    
            <div class="flex gap-2">
                <flux:spacer />
    
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
    
                <flux:button type="submit" variant="danger" wire:click="rejectDemand">Reject Demand</flux:button>
            </div>
        </div>
    </flux:modal>
</div> 