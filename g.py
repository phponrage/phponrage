__author__ = 'Alpha Solutions'

import sys
import os

def main():
    #nazwa klasy
    try:
        name = sys.argv[1]
    except:
        print "syntax error, you don't send any argument for class name"
        return 0

    #generowanie skladnikow mvc
    m = False #model
    v = False #view
    c = False #controller
    try:
        for symbol in sys.argv[2]:
            if symbol == 'm':
                m = True
            elif symbol == 'v':
                v = True
            elif symbol == 'c':
                c = True
            else:
                print "syntax error, bad arguments for mvc"
                return 0
    except:
        print "syntax error, you don't send any arguments for use model/view/controller"
        return 0

    #generowanie elementow operayjnych
    n = False #new
    d = False #delete
    e = False #edit
    s = False #show element
    l = False #show list of elements

    try:
        for symbol in sys.argv[3]:
            if symbol == 'n':
                n = True
            elif symbol == 'd':
                d = True
            elif symbol == 'e':
                e = True
            elif symbol == 's':
                s = True
            elif symbol == 'l':
                l = True
            elif symbol == '0':
                l = True
            else:
                print "syntax error, bad arguments for new/edit/delete/show/list"
                return 0
    except:
        print "syntax error, you don't send any arguments for use new/edit/delete/show/list"
        return 0

    #tworzenie plikow i katalogow dla modelu i migracji
    if m == True:

        try:
            os.makedirs('app/model/' + name)
        except:
            print "folder with that name of model already exist!"
        textModel = "<?php\n\ninclude_once ('app/model/model.php');\n\nclass M" + name + " extends Model{\n"

        textModel += "\n\tfunction __construct($id,$action,$param){\n\n"

        for arg in sys.argv[4:]:
            datas = arg.split(':')
            textModel +=  "\t\t$" + datas[0] + " = null;\n\n"

        for arg in sys.argv[4:]:
            datas = arg.split(':')
            textModel +=  "\t\tif(isset($_POST['" + datas[0] + "']))\n"
            textModel +=  "\t\t\t$" + datas[0] + " = is_numeric($_POST['" + datas[0] + "'])?(int)$_POST['" + datas[0] + "']:$_POST['" + datas[0] + "'];\n\n"

        textModel += "\t\t$fields = array("
        i = False
        for arg in sys.argv[4:]:
            datas = arg.split(':')
            if i == False:
                textModel +=  "\"" + datas[0] + "\"" + " => $" + datas[0]
                i = True
            else:
                textModel +=  ",\"" + datas[0] + "\"" + " => $" + datas[0]

        textModel += ");\n\n\t\tparent::__construct('T"+name+"',$fields, $action, $id, $param);\n\t}\n}"
        fileModel = open('app/model/' + name + '/' + name +'.php', 'w')
        fileModel.write(textModel)

        fileModel.close()

        i = 0
        textMigrations = "<?php\n"
        textMigrations += "\t$create = mysql_query('CREATE TABLE T" + name + " (ID int NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID)"
        for arg in sys.argv[4:]:
            datas = arg.split(':')
            textMigrations += ","
            for field in datas:
                if i == 0:
                    textMigrations += " " + field
                if i == 1:
                    textMigrations += " " + field
                if i == 2 and field == "0":
                    pass
                elif i == 2 and field == "1":
                    textMigrations += " NOT NULL"
                if i == 3:
                    if datas[1]=="int":
                        textMigrations += " DEFAULT " + field
                    else:
                        textMigrations += " DEFAULT \"" + field +"\""
                i += 1

            i = 0


        textMigrations += ")', $connect); "
        textMigrations += "\n\n\tif($create)\n\t\techo 'Creating succesfull';"
        textMigrations += "\n\telse\n\t\techo 'table T" + name + " Problem with installation<br />';"
        fileMigrations = open('app/migrations/'+ name +'.php', 'w')
        fileMigrations.write(textMigrations)
        fileMigrations.close()

        #tworzenie plikow i katalogow dla widoku
    if v == True:
        try:
            os.makedirs('app/view/' + name)
        except:
            print "folder with that name of view already exist!"

        if n == True:
            textNew = "<?php\n$content=\"\n<h2>New item</h2> \n\n"
            textNew += "<form action='#' method='post'>\n\n"
            for arg in sys.argv[4:]:
                datas = arg.split(':')
                textNew +="\t<p><label for='" + datas[0] + "'>" + datas[0] + "</label>\n"
                textNew +="\t<input type='text' name='" + datas[0] + "'></p>\n\n"

            textNew += "\t<p><input type='submit' value='New' /></p>\n\n"
            textNew += "</form>\n\";"
            fileNew = open('app/view/' + name + '/new.php', 'w')
            fileNew.write(textNew)
            fileNew.close()

        if e == True:
            textEdit = "<?php\n$content=\"\n<h2>Edit item</h2> \n\n"
            textEdit += "<form action='#' method='post'>\n\n"
            for arg in sys.argv[4:]:
                datas = arg.split(':')
                textEdit +="\t<p><label for='" + datas[0] + "'>" + datas[0] + "</label>\n"
                textEdit +="\t<input type='text' name='" + datas[0] + "' value=\".$model->get(\'"+ datas[0] +"\').\"></p>\n\n"

            textEdit += "\t<p><input type='submit' value='Save' /></p>\n\n"
            textEdit += "</form>\n\";"
            fileEdit = open('app/view/' + name + '/edit.php', 'w')
            fileEdit.write(textEdit)
            fileEdit.close()

        if s == True:
            textShow = "<?php\n$content=\"\n<h2>Item description</h2> \n\n<table>\n"

            for arg in sys.argv[4:]:
                datas = arg.split(':')
                textShow += '\t<tr><td> '+ datas[0] +'</td><td> ".$model->get(\''+ datas[0] +'\')."</td></tr>\n'
            textShow += '</table>\n'

            textShow += '<a href=\'/'+name+'/edit/".$model->get(\'id\')."\'>Edit</a><br />\n'
            textShow += '<a href=\'/'+name+'/del/".$model->get(\'id\')."\'>Delete</a>'

            textShow += '";'
            fileShow = open('app/view/' + name + '/show.php', 'w')
            fileShow.write(textShow)
            fileShow.close()

        if l == True:
            textList = "<?php\n$content=\"\n<h2>List of items</h2> \n\n <%= list %>\n\";"
            fileList = open('app/view/' + name + '/list.php', 'w')
            fileList.write(textList)
            fileList.close()

        #tworzenie plikow i katalogow dla kontrolera
    if c == True:
        try:
            os.makedirs('app/controller/' + name)
        except:
            print "folder with that name of controller already exist!"

        textController = "<?php\n\ninclude_once ('app/controller/controller.php');\n\n"
        if m == True:
            textController +="include_once ('app/model/"+name+"/"+name+".php');"
        textController +="\n\nclass C" + name + " extends Controller{\n"

        textController += "\n\tfunction __construct($name, $action, $id, $param){"
        textController += "\n\n\t\t$this->layout = 'default';"

        if m == True:

            textController += "\n\n\t\t$this->model = new M"+name+"($id, $action, $param);"


        textController += "\n\n\t\tparent::__construct($name, $action, $id, $param);"
        textController += "\n\t}\n}\n$controller = new C"+name+"($name, $action, $id, $param);"
        fileController = open('app/controller/' + name + '/' + name +'.php', 'w')
        fileController.write(textController)
        fileController.close()

if __name__ == "__main__":
    main()