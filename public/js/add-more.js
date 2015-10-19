
	// code for the primary contact
        $(document).ready(function() {
            $('#btnAdd').click(function() {
                var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#primaryinput' + num).clone().attr('id', 'primaryinput' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children('input:first').attr('id', 'primary_number_' + newNum).attr('name', 'primary_number_' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#primaryinput' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel').attr('disabled','');
 
                // business rule: you can only add 5 names
                if (newNum == 5)
                    $('#btnAdd').attr('disabled','disabled');
            });
 
            $('#btnDel').click(function() {
                var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
                $('#primaryinput' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel').attr('disabled','disabled');
            });
 
            $('#btnDel').attr('disabled','disabled');


	// code for the first secondary contact
            $('#btnAdd1').click(function() {
                var num     = $('.clonedInput1').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#secondary1input' + num).clone().attr('id', 'secondary1input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children('input:first').attr('id', 'secondary1_number_' + newNum).attr('name', 'secondary1_number_' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#secondary1input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel1').attr('disabled','');
 
                // business rule: you can only add 5 names
                if (newNum == 5)
                    $('#btnAdd1').attr('disabled','disabled');
            });
 
            $('#btnDel1').click(function() {
                var num = $('.clonedInput1').length; // how many "duplicatable" input fields we currently have
                $('#secondary1input' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd1').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel1').attr('disabled','disabled');
            });
 
            $('#btnDel1').attr('disabled','disabled');


	// code for the second secondary contact
            $('#btnAdd2').click(function() {
                var num     = $('.clonedInput2').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#secondary2input' + num).clone().attr('id', 'secondary2input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children('input:first').attr('id', 'secondary2_number_' + newNum).attr('name', 'secondary2_number_' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#secondary2input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel2').attr('disabled','');
 
                // business rule: you can only add 5 names
                if (newNum == 5)
                    $('#btnAdd2').attr('disabled','disabled');
            });
 
            $('#btnDel2').click(function() {
                var num = $('.clonedInput2').length; // how many "duplicatable" input fields we currently have
                $('#secondary2input' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd2').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel2').attr('disabled','disabled');
            });
 
            $('#btnDel2').attr('disabled','disabled');

	// code for the third secondary contact
            $('#btnAdd3').click(function() {
                var num     = $('.clonedInput3').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#secondary3input' + num).clone().attr('id', 'secondary3input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children('input:first').attr('id', 'secondary3_number_' + newNum).attr('name', 'secondary3_number_' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#secondary3input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel3').attr('disabled','');
 
                // business rule: you can only add 5 names
                if (newNum == 5)
                    $('#btnAdd3').attr('disabled','disabled');
            });
 
            $('#btnDel3').click(function() {
                var num = $('.clonedInput3').length; // how many "duplicatable" input fields we currently have
                $('#secondary3input' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd3').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel3').attr('disabled','disabled');
            });
 
            $('#btnDel3').attr('disabled','disabled');

	// code for the fourth secondary contact
            $('#btnAdd4').click(function() {
                var num     = $('.clonedInput4').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#secondary4input' + num).clone().attr('id', 'secondary4input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children('input:first').attr('id', 'secondary4_number_' + newNum).attr('name', 'secondary4_number_' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#secondary4input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel4').attr('disabled','');
 
                // business rule: you can only add 5 names
                if (newNum == 5)
                    $('#btnAdd4').attr('disabled','disabled');
            });
 
            $('#btnDel4').click(function() {
                var num = $('.clonedInput4').length; // how many "duplicatable" input fields we currently have
                $('#secondary4input' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd4').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel4').attr('disabled','disabled');
            });
 
            $('#btnDel4').attr('disabled','disabled');

	// code for the fifth secondary contact
            $('#btnAdd5').click(function() {
                var num     = $('.clonedInput5').length; // how many "duplicatable" input fields we currently have
                var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
                var newElem = $('#secondary5input' + num).clone().attr('id', 'secondary5input' + newNum);
 
                // manipulate the name/id values of the input inside the new element
                newElem.children('input:first').attr('id', 'secondary5_number_' + newNum).attr('name', 'secondary5_number_' + newNum);
 
                // insert the new element after the last "duplicatable" input field
                $('#secondary5input' + num).after(newElem);
 
                // enable the "remove" button
                $('#btnDel5').attr('disabled','');
 
                // business rule: you can only add 5 names
                if (newNum == 5)
                    $('#btnAdd5').attr('disabled','disabled');
            });
 
            $('#btnDel5').click(function() {
                var num = $('.clonedInput5').length; // how many "duplicatable" input fields we currently have
                $('#secondary5input' + num).remove();     // remove the last element
 
                // enable the "add" button
                $('#btnAdd5').attr('disabled','');
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDel5').attr('disabled','disabled');
            });
 
            $('#btnDel5').attr('disabled','disabled');

	// now the toggle for each one

            $('#add_button_1').click(function() {
                $('#secondary2').show("slow");
		$('#add_button_1').hide("slow");
            });

            $('#add_button_2').click(function() {
                $('#secondary3').show("slow");
		$('#add_button_2').hide("slow");
            });

            $('#add_button_3').click(function() {
                $('#secondary4').show("slow");
		$('#add_button_3').hide("slow");
            });

            $('#add_button_4').click(function() {
                $('#secondary5').show("slow");
		$('#add_button_4').hide("slow");
            });

        });