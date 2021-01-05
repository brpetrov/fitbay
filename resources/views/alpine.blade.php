<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
</head>
<body>
<div x-data="game()" class="px-10 flex items-center justify-center min-h-screen">
    <h1 class="fixed top-3 right-3 font-bold text-3xl" x-text="points"></h1>
<div class="grid grid-cols-4 gap-10 flex-1">
    <template x-for="card in cards">
        <div>
            <button
            x-show="!card.cleared"
            :style="'background: ' + (card.flipped ? card.color : '#999')"
            class="h-32 w-full"
            @click="flipCard(card)"
            >
            </button>
        </div>
    </template>
</div>
</div>

<div
x-data="{show:false, message:'Default message'}"
x-show.trasition.opacity="show"
x-text="message"
@flash.window="message=$event.detail.message;
 show=true;
 setTimeout(()=> show=false, 1000)
 "
class="fixed bottom-3 right-3"
>
</div>

<script>
    function flash(message) {
        window.dispatchEvent(new CustomEvent('flash',{
            detail:{message}
        }))
    }
    function game() {
        return {
            cards:[
                {color:'green',flipped:false, cleared:false},
                {color:'red',flipped:false, cleared:false},
                {color:'blue',flipped:false, cleared:false},
                {color:'yellow',flipped:false, cleared:false},
                {color:'green',flipped:false, cleared:false},
                {color:'red',flipped:false, cleared:false},
                {color:'blue',flipped:false, cleared:false},
                {color:'yellow',flipped:false, cleared:false}
            ],

            get flippedCards(){
                return this.cards.filter(card=>card.flipped)
            },

            get clearedCards(){
                return this.cards.filter(card=>card.cleared)
            },

            get remainingCards(){
                return this.cards.filter(card=> !card.cleared)
            },

            get points(){
               return this.clearedCards.length
            },

            flipCard(card) {
                if (this.flippedCards.length===2) {
                    return
                }
                card.flipped = !card.flipped
                if (this.flippedCards.length === 2) {
                   if (this.hasMatch()) {
                       flash('you found a match!')
                       setTimeout(()=>{
                        this.flippedCards.forEach(card=>card.cleared=true)
                       },1000)


                    //    is the game over
                    // if there are no remaining cards
                    if ( ! this.remainingCards.length) {
                        this.show=true
                    }
                   }
                   setTimeout(()=>{
                    this.flippedCards.forEach(card=>card.flipped=false)
                   },1000)

                }
            },

            hasMatch(){
                return this.flippedCards[0]['color']=== this.flippedCards[1]['color']
            },
        }
    }

</script>
</body>
</html>
