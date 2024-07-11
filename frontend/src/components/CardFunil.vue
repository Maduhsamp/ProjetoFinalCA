    <template>
        <div class="card-container">
            <div class="card" v-for="funil in funis" :key="funil.id">
                {{ funil.name }}
                <button @click="updateFunil(funil)"><i class='bx bxs-pencil'></i></button>
                <button class="btnDelete" @click="deleteFunil(funil)"><i class='bx bxs-trash'></i></button>
            </div>
        </div>
    </template>
    <script>
    import axios from 'axios';

    export default{
        name: 'CardFunil',
        methods: {
            getFunis() {
                axios.get('/api/funis')
                    .then(response => {
                        this.funis = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            updateFunil(funil) {
                axios.put(`/api/funis/${funil.id}`, funil)
                    .then(response => {
                        this.funis.forEach(f => {
                            if (f.id === funil.id) {
                                Object.assign(f, funil);
                            }
                        });
                        this.showModal = false;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },

            deleteFunil(funil) {
                axios.delete(`/api/funis/${funil.id}`)
                    .then(() => {
                        this.funis = this.funis.filter(f => f.id !== funil.id);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
    </script>
    <style scoped>
        *{
            background: #f8f8f8;
            height: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card-container{
            padding-top: 80px;
            display: flex;
            flex-wrap: wrap;
            align-content: flex-start;       
        }

        .card{
            background: white;
            width: 240px;
            height: 114px;
            border-radius: 10px;
            padding: 10px;
            margin: auto 30px;
            border: #E1E9F4 solid 1px;
            display: inline-block;
            gap: 0px;
            margin-bottom: 10px; 
            
        }


        .btnDelete{
            color: #b90927;
            border: none;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            font-weight: 500;
            transition: .5s;
            margin-right: 10px;
            background: transparent;
            justify-content: space-between;
            height: 10px;
            background: transparent;
        }

        h2{
            background: transparent;
            max-height: 70px;
            font-size: 24px;
        }
    </style>