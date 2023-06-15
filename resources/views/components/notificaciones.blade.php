<div
@if (session()->has('notification')) 
    x-data="{body: ''}"
    x-show="body.length"
    x-cloak
    x-on:notification.window="body = $event.detail.body; setTimeout(() => body = '', $event.detail.timeout || 2000)"
    class="fixed inset-0 flex px-4 py-6 items-start pointer-events-none"
    x-init="
     window.onload = () => {
                window.dispatchEvent(new CustomEvent('notification', {
                    detail: {
                        body: '{{ session('notification') }}',
                        timeout: 5000
                    }
                }))
            }
    ">
    <div class="w-full flex justify-end space-y-4 drop-shadow-lg bg-white">
        <div class="max-w-xl w-full rounded-lg border border-l-4 border-check-green pointer-events-auto">
            <div class="p-4 flex items-center drop-shadow-lg">
                <div class="ml-2 w-0 flex-1 text-check-green">
                    <span x-text="body">El usuario fue registrado de forma satisfactoria, debe esperar la aprobación del Administrador</span>
                </div>
                <button class="inline-flex text-gray-400" x-on:click="body = ''">
                    <span class="sr-only">Close</span>
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>

  