<template>
    <div class="scroll-container">
        <div class="colunas">
            <div class="se">
                <div class="linha">
                    <label>Sem etapa</label>
                    <button class="reset-button"><i class='bx bx-plus'></i></button>
                </div>
                <CardContato :etapaId="1" />
                
            </div>
            <div class="pc">
                <div class="linha">
                    <label>Prospecção</label>
                    <button class="reset-button"><i class='bx bx-plus'></i></button>
                </div>
                <CardContato :etapaId="2"/>
                
            </div>
            <div class="c">
                <div class="linha">
                    <label>Contato</label>
                    <button class="reset-button"><i class='bx bx-plus'></i></button>
                </div>
                <CardContato :etapaId="3"/>
                
            </div>
            <div class="p">
                <div class="linha">
                    <label>Proposta</label>
                    <button class="reset-button "><i class='bx bx-plus'></i></button>
                </div>
                <CardContato :etapaId="4"/>
                
            </div>
        </div>
    </div>
</template>

<script>
import CardContato from './CardContato.vue';

export default {
    name: 'ColunasEtapas',
    components:{
        CardContato
    },
    data(){
        return{
            etapa_id: 1
        }
    }
    
}
</script>

<style scoped>
.reset-button {
    all: unset; 
    cursor: pointer; 
}

.scroll-container {
    overflow-x: auto; 
    padding-right: 10%;
}

.colunas {
    display: flex;
    margin-top: 50px;
    margin-left: 12px;
    padding-right: 10%;

    label {
        font-weight: 600;
    }

    i {
        position: absolute;
        width: 30px;
        height: 30px;
        font-size: 1.1em;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #E1E9F4;
        color: #72869A;
        top: 20px;
    }
}

.se, .pc, .c, .p {
    position: relative;
    padding-top: 23px;
    padding-left: 8px; 
    padding-right: 130px;
    margin-left: 15px; 
    width: 240px;
}

.se::before, .pc::before, .c::before, .p::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 7px;
    border-radius: 5px;
}

.se::before {
    width: 240px;
    background: #D2DDEC;
}

.pc::before {
    width: 100%;
    background: #CCB6FC;
}

.c::before {
    width: 100%;
    background: #9C6BFF;
}

.p::before {
    width: 100%;
    background: #7036E4;
}

.se:hover, .pc:hover, .c:hover, .p:hover {
    background-color: #F0F4FA;
    border-radius: 5px;
    padding-bottom: 20px;
;
}

.scroll-container::-webkit-scrollbar {
    width: 10px;
    height: 4px;
}

.scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1; 
}

.scroll-container::-webkit-scrollbar-thumb {
    background-color: #B1C2D9; 
    border-radius: 5px;
    cursor: pointer;
}

.scroll-container::-webkit-scrollbar-thumb:hover {
    background-color: #83a8e0; 
}

.linha{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 195px;
}
</style>
