    <template>
        <div class="card-container">

            <div class="card">
                <h2>Funil</h2>
                <button class="btnDelete"><i class='bx bxs-trash' ></i></button>
            </div>

            
        </div>
        </template>
    <script>

    export default{
        name: 'CardFunil'
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