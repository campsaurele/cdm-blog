<?php

require_once(__DIR__.'/button.php');

function modal(string $lign, string $id, string $title)
{


    return "<div class=\"modal fade\" id=\"modal".$id."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"modal".$id."label\" aria-hidden=\"true\">
        <div class=\"modal-dialog\" role=\"document\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"modal".$id."label\">Confirmation de suppression</h5>

            </div>
                <div class=\"modal-body\">
                    <form action=\"/cdm-blog/admin/delete.php?t=".$lign."&id=".$id."\" method=\"POST\">

                        <div class=\"mb-3\">
                        <!-- Label informatif (même s'il est caché) -->
                        <label for=\"id\" class=\"form-label\">Voulez-vous supprimer \"".$title."\" ".$lign." n°".$id." ?</label>

                        <!--
                            type=\"hidden\" : le champ n'est pas visible mais sera envoyé avec le formulaire
                            value=".$id." : on passe l'ID à supprimer
                        -->
                        <input type=\"hidden\" class=\"form-control\" id=\"id\" name=\"id\" value=\"".$id."\">
            </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Retour</button>
                    <button type=\"submit\" class=\"btn btn-danger\">Supprimer définitivement</button>
                <br>
                
                </form>
                    </div>
                    </div>
                    </div>
                    </div>";
}
