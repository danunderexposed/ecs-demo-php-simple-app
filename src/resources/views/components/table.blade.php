    <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
        @if(isset($head))
            <thead class="bg-gray-100">
                <tr>
                    {{ $head }}
                </tr>
            </thead>
        @endif

        <tbody class="bg-white divide-y divide-gray-200">
            @if(isset($body))
                {{ $body }}
            @endif
        </tbody>

    </table>
