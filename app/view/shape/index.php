<h1>Рисование фигуры</h1>

<form method="get" action="/shape/draw">
    Формат: <select name="output">
        <option value="json">JSON</option>
        <option value="xml">XML</option>
        <option value="picture">Картинка</option>
    </select><br/><br/>

    <fieldset style="width: 30%">
        Выберите фигуру: <select name="shapes[1][type]">
            <option value="circle">Круг</option>
        </select>
        <br/>
        Радиус:
        <input type="number" name="shapes[1][params][radius]" value="5"><br/>
    </fieldset>


    <br/>
    <input type="submit" value="Нарисовать">
</form>