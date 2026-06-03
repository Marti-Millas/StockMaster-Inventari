## Configuració de la base de dades
És necessària la creació d'una base de dades d'on s'obtindran els productes. 

La taula que es consulta es pot crear amb l'script:

```sql
-- Crear la base de dades si no existeix
CREATE DATABASE IF NOT EXISTS `products`;

-- Seleccionar la base de dades per a les operacions següents
USE `products`;

-- Ara ja pots crear la taula
CREATE TABLE `products` (
  `cod` int(11) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `pvp` decimal(5,2) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


Per afegir productes a la taula ```products```  pots utilitzar l'script:

```
INSERT INTO `products` (`cod`, `short_name`, `pvp`, `nombre`) VALUES
(1, 'Monitor', '400.00', 'Dell 21 full HD'),
(2, 'Teclado', '9.99', 'Teclado inalámbrico Logitech'),
(3, 'iPad Pro', '900.00', 'Apple iPad Pro 9');
```

## Resum patró MVC

Hi ha 3 nivells d'abstracció:

    Model.- És qui defineix la lògica de negoci. Són les classes i els mètodes que es comuniquen directament amb la base de dades.

    Vista.- Mostra la informació a l'usuari de manera lògica i llegible.

    Controlador.- És l'intermediari entre la vista i el model. Controla les interaccions de l'usuari a la vista. Demana les dades al model i les retorna a la vista perquè les mostri. És l'encarregat de realitzar les crides a les classes i als mètodes.

Funcionament del MVC

    L'usuari fa una petició.

    El controlador captura la petició.

    El controlador fa la crida al model corresponent.

    El model interactua amb la base de dades.

    El controlador rep la informació del model (base de dades) i l'envia a la vista.

    La vista mostra la informació.
**Diagrama MVC**

![](mvc-diagram.png) 

