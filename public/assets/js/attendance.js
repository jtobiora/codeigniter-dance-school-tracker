$(function() {
    let selectedMember = null;

    $("#member-search").autocomplete({
        source: '/members/search',
        minLength: 2,
        select: function(event, ui) {
            selectedMember = ui.item;
        }
    });

    $("#add-member-btn").click(function() {
        addSelectedMember();
    });

    $("#member-search").keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault();
            addSelectedMember();
        }
    });

    function addSelectedMember() {
        if (selectedMember) {
            if ($(`input[name="members[]"][value="${selectedMember.id}"]`).length > 0) {
                alert('This member has already been added.');
                $("#member-search").val('');
                selectedMember = null;
                return;
            }

            const newRow = `
                <tr>
                    <td>
                        ${selectedMember.label}
                        <input type="hidden" name="members[]" value="${selectedMember.id}">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="attendance[${selectedMember.id}]" value="1" checked>
                    </td>
                    <td>
                        <input type="text" name="notes[${selectedMember.id}]" class="form-control">
                    </td>
                </tr>
            `;

            $("table tbody").append(newRow);
            $("#member-search").val('');
            selectedMember = null;
        } else {
            alert('Please select a member from the autocomplete list.');
        }
    }
});
