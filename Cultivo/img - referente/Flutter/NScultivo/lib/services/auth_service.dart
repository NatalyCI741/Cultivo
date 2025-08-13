import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import '../models/user_model.dart';

class AuthService {
  // Cambia esta URL por la URL de tu API backend
  final String _baseUrl = 'http://127.0.0.1:8000/api';
  final _storage = const FlutterSecureStorage();

  // Almacenar el token
  Future<void> _saveToken(String token) async {
    await _storage.write(key: 'token', value: token);
  }

  // Obtener el token
  Future<String?> getToken() async {
    return await _storage.read(key: 'token');
  }

  // Registro
  Future<Map<String, dynamic>> register(String name, String email, String password) async {
    try {
      final response = await http.post(
        Uri.parse('$_baseUrl/register'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'name': name,
          'email': email,
          'password': password,
          'role': 'cliente', // Por defecto, todos los nuevos usuarios son clientes
        }),
      );

      if (response.statusCode == 201) {
        final Map<String, dynamic> data = json.decode(response.body);
        if (data['token'] != null) {
          await _saveToken(data['token']);
          return {
            'success': true,
            'user': User.fromJson(data['user']),
            'message': 'Registro exitoso'
          };
        }
        return {
          'success': false,
          'message': 'Error en la respuesta del servidor'
        };
      } else if (response.statusCode == 422) {
        final Map<String, dynamic> data = json.decode(response.body);
        return {
          'success': false,
          'message': data['message'] ?? 'El email ya está registrado'
        };
      } else {
        return {
          'success': false,
          'message': 'Error del servidor: ${response.statusCode}'
        };
      }
    } on SocketException {
      return {
        'success': false,
        'message': 'No se puede conectar al servidor. Verifica tu conexión a internet.'
      };
    } catch (e) {
      return {
        'success': false,
        'message': 'Error inesperado: $e'
      };
    }
  }

  // Login
  Future<Map<String, dynamic>> login(String email, String password) async {
    try {
      final response = await http.post(
        Uri.parse('$_baseUrl/login'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'email': email,
          'password': password,
        }),
      );

      if (response.statusCode == 200) {
        final Map<String, dynamic> data = json.decode(response.body);
        if (data['token'] != null) {
          await _saveToken(data['token']);
          return {
            'success': true,
            'user': User.fromJson(data['user']),
            'message': 'Inicio de sesión exitoso'
          };
        }
        return {
          'success': false,
          'message': 'Error en la respuesta del servidor'
        };
      } else if (response.statusCode == 401) {
        return {
          'success': false,
          'message': 'Credenciales inválidas'
        };
      } else {
        return {
          'success': false,
          'message': 'Error del servidor: ${response.statusCode}'
        };
      }
    } on SocketException {
      return {
        'success': false,
        'message': 'No se puede conectar al servidor. Verifica tu conexión a internet.'
      };
    } catch (e) {
      return {
        'success': false,
        'message': 'Error inesperado: $e'
      };
    }
  }

  // Logout
  Future<void> logout() async {
    await _storage.delete(key: 'token');
  }

  // Verificar estado de autenticación
  Future<bool> isAuthenticated() async {
    final token = await getToken();
    return token != null;
  }
} 