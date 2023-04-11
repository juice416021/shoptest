<x-jet-action-section>
    <x-slot name="title">
        {{ __('刪除帳戶') }}
    </x-slot>

    <x-slot name="description">
        {{ __('永久刪除您的帳戶。') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            一旦你的帳戶被刪除，所有相關的資源和數據都將永久刪除。在刪除帳戶之前，請下載你想保留的任何數據或信息。
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('刪除帳號') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('刪除帳號') }}
            </x-slot>

            <x-slot name="content">
                你確定要刪除你的帳號嗎？一旦帳號被刪除，它的所有資源和數據將被永久刪除。請輸入你的密碼以確認你要永久刪除你的帳號。
                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('密碼') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('取消') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('刪除帳號') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
