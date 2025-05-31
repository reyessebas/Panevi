# Programa de gestión de consumo de agua

# Datos almacenados
registros = []

# Funciones
def agregar_registro():
    nombre = input("Ingrese el nombre de la persona: ")
    vereda = input("Ingrese la vereda (Santa Rosa, Providencia, Mesitas, Cristales): ")
    consumo = float(input("Ingrese el consumo de agua en litros: "))
    if vereda not in ["Santa Rosa", "Providencia", "Mesitas", "Cristales"]:
        print("Vereda no válida. Intente de nuevo.")
        return
    registros.append({"nombre": nombre, "vereda": vereda, "consumo": consumo})
    print("Registro agregado correctamente.\n")

def mostrar_registros():
    if not registros:
        print("No hay registros aún.\n")
        return
    print("Registros de consumo:")
    for idx, registro in enumerate(registros, 1):
        print(f"{idx}. Nombre: {registro['nombre']}, Vereda: {registro['vereda']}, Consumo: {registro['consumo']} litros")
    print()

def total_por_vereda():
    totales = {"Santa Rosa": 0, "Providencia": 0, "Mesitas": 0, "Cristales": 0}
    for registro in registros:
        totales[registro["vereda"]] += registro["consumo"]
    print("Total de consumo por vereda:")
    for vereda, total in totales.items():
        print(f"{vereda}: {total} litros")
    print()

def menu():
    while True:
        print("Menú de opciones:")
        print("1. Agregar registro de consumo")
        print("2. Mostrar registros")
        print("3. Total de consumo por vereda")
        print("4. Salir")
        opcion = input("Seleccione una opción: ")
        if opcion == "1":
            agregar_registro()
        elif opcion == "2":
            mostrar_registros()
        elif opcion == "3":
            total_por_vereda()
        elif opcion == "4":
            print("Saliendo del programa. ¡Hasta luego!")
            break
        else:
            print("Opción no válida. Intente de nuevo.\n")

# Ejecutar el programa
menu()
