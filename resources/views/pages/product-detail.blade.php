<form action="{{ route('checkout.process') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label>Jumlah:</label>
    <input type="number" name="quantity" value="1" min="1">

    <button type="submit">Beli Langsung</button>
</form>