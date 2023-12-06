<script>
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    @if(session('fail'))
        toastr.error('{{ session('fail') }}');
    @endif

    @if($errors->any())
        @foreach ($errors->all as $item)
            toastr.error('{{ $item }}');
        @endforeach
    @endif

</script>
