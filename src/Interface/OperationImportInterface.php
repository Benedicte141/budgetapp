<?php
namespace App\Interface;
use App\Entity\Operation;
use App\Entity\Banque;

interface OperationImportInterface {
    /**
    * Importe les opérations d'un compte bancaire depuis une API bancaire
    * @param Banque $banque l'API bancaire
    * @param array $options options pour configurer l'importation (e.g., période)
    */


    public function importOperations(Banque $banque, array $options = []): void;
    /**
    * Parse une opération bancaire depuis l'API bancaire en utilisant le mapping de champs défini dans fieldMapping
    * @param array $operationArray tableau associatif de l'opération bancaire
    * @return ?Operation retourne une opération ou null si le parsing échoue
    */


    public function parseOperation(array $operationArray): ?Operation;
    /**
    * Vérifie la validité des champs d'une opération
    * @param Operation $operation
    * @return bool
    */


    public function validateOperation(Operation $operation): bool;
    /**
    * Retourne uniquement les opérations valides qui n'existent pas déjà dans la base de données (avec externalId)
    * @param Operation[] $normalizedOperations tableau associatif des opérations bancaires
    * @return Operation[] tableau des opérations non dupliquées
    */



    public function checkDuplicates(array $normalizedOperations): array;
    /**
    * Retourne la liste des erreurs d'importation avec leur contexte
    * @return array<array{error: ImportationError, operation: ?Operation}>
    */



    public function getImportationErrors(): array;
    /**
    * Retourne les opérations importées lors de la dernière importation
    * @return Operation[]
    */


    
    public function getOperations(): array;
    }