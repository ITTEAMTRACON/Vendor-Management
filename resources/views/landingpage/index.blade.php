@extends('index')
@include('components.header-landingpage')
@section('main_container')
    @vite(['resources/sass/landingpage/landingpage.scss'])
    <form class="carousels">
        <input type="radio" name="fancy" autofocus value="clubs" id="clubs" checked />
        <input type="radio" name="fancy" value="hearts" id="hearts" />
        <input type="radio" name="fancy" value="spades" id="spades" />
        <input type="radio" name="fancy" value="diamonds" id="diamonds" />
        <label for="clubs"><img src="images/tracon_logo.jpg" /> <span>Tracon Industri</span></label>
        <label for="hearts"><img src="images/tracon_logo.jpg" /> <span>Tracon Industri</span></label>
        <label for="spades"><img src="images/tracon_logo.jpg" /> <span>Tracon Industri</span></label>
        <label for="diamonds"><img src="images/tracon_logo.jpg" /> <span>Tracon Industri</span></label>
        {{-- <label for="clubs"><img src="images/tracon_logo.jpg" /> <span>Tracon Industri</span></label><label for="hearts">&#9829; Hearts</label><label for="spades">&#9824; Spades</label><label for="diamonds">&#9830; Diamonds</label> --}}
        <div class="keys">Use left and right keys to navigate</div>
    </form>
    <script>
        const elements = document.querySelectorAll('input[type="radio"]');

        function looping() {
            setTimeout((element) => {
                const checkedIndices = [];
                Array.from(elements).forEach((checkbox, index) => {
                    if (checkbox.checked) {
                        checkedIndices.push(index);
                    }
                });
                if(checkedIndices[0]+1 > 3){
                    elements[0].checked = true;
                }else{
                    elements[checkedIndices[0]+1].checked = true;
                }
                
                looping()
            }, 5000);
        }
        // looping()
    </script>
@endsection
